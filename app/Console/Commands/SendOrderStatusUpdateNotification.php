<?php

namespace App\Console\Commands;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AdminOrderController;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:order_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will update the order status.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the list of orders of every day which are not handed yet.
        Order::whereDate('created_at',now())->where('status','<',5)->chunk(5,function($orders) {
            foreach ($orders as $order) {
                $adminOrderController = new AdminOrderController();
                // Why request instance ? = controller function accept status as request instance
                $custom_request = new Request(['status' => $order->status + 1]);
                $adminOrderController->updateStatus($custom_request,$order);
            }
        });
    }
}
