<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function transactionProcess(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:14',
            'address' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0'
        ]);

        try {
            DB::enableQueryLog();

            $transactionData = DB::transaction(function () use ($request) {
                $customer = Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address
                ]);

                $transaction = Transaction::create([
                    'product_id' => $request->product_id,
                    'customer_id' => $customer->id,
                    'quantity' => $request->quantity,
                    'total_price' => $request->total_price,
                    'status' => 'pending'
                ]);

                return compact('transaction', 'customer');
            });

            if (!$transactionData || !isset($transactionData['transaction']) || !isset($transactionData['customer'])) {
                throw new \Exception("Transaksi gagal diproses.");
            }

            $transaction = $transactionData['transaction'];
            $customer = $transactionData['customer'];

            // Set konfigurasi Midtrans
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => rand(),
                    'gross_amount' => $transaction->total_price,
                ],
                'customer_details' => [
                    'first_name' => $customer->name,
                    'email' => $customer->email
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $transaction->snap_token = $snapToken;
            $transaction->save();

            return view('paymentConfirm', compact('transaction'));
        } catch (\Exception $e) {
            $queryLog = DB::getQueryLog();
            if (!is_array($queryLog)) {
                $queryLog = [];
            }
            Log::error('Transaksi gagal: ' . $e->getMessage(), ['query_log' => $queryLog]);
            return back()->with('error', 'Terjadi kesalahan dalam transaksi: ' . $e->getMessage());
        }
    }

    public function success($order_id)
    {
        $transaction = Transaction::findOrFail($order_id);
        $transaction->status = 'success';
        $transaction->save();

        return view('paymentSuccess');
    }
}