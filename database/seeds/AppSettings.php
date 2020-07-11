<?php

use App\Models\Customer;
use App\Models\Language;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class AppSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = Customer::create([
            'name' => 'John Doe',
            'phone' => '123 456 789',
            'email' => 'johndoe@example.com',
            'address' => 'Customer Address',
            'status' => 1,
        ]);

        Language::create([
            'language' => 'EN ( English )',
            'iso_code' => 'en',
            'flag' => 'backend/img/flag/en.png',
            'status' => 1,
        ]);


       Settings::create(['option_key' => 'app_name', 'option_value' => 'MB POS']);
       Settings::create(['option_key' => 'app_language', 'option_value' => 'en']);
       Settings::create(['option_key' => 'app_date_format', 'option_value' => 'm/d/Y']);
       Settings::create(['option_key' => 'app_timezone', 'option_value' => 'Europe/London']);
       Settings::create(['option_key' => 'app_currency', 'option_value' => '$']);
       Settings::create(['option_key' => 'product_sku_prefix', 'option_value' => 'P']);
       Settings::create(['option_key' => 'purchase_invoice_prefix', 'option_value' => 'P']);
       Settings::create(['option_key' => 'sell_invoice_prefix', 'option_value' => 'S']);
       Settings::create(['option_key' => 'requisition_id_prefix', 'option_value' => 'R']);
       Settings::create(['option_key' => 'expense_id_prefix', 'option_value' => 'E']);
       Settings::create(['option_key' => 'invoice_length', 'option_value' => '6']);
       Settings::create(['option_key' => 'address', 'option_value' => 'Your Company Address']);
       Settings::create(['option_key' => 'vat_reg_no', 'option_value' => 'VAT-123 456 789']);
       Settings::create(['option_key' => 'default_customer', 'option_value' => $customer->id]);
       Settings::create(['option_key' => 'phone', 'option_value' => '0123 456 789']);
       Settings::create(['option_key' => 'login_banner', 'option_value' => 'images/default-banner.jpg']);
    }
}
