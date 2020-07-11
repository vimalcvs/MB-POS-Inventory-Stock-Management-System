<template>
    <!-- Begin Page Content -->
    <div class="container-fluid pl-2 pr-2">
        <div class="row sell-pos">
            <div class="col-md-5 pr-0">
                <div class="card mb-2 rounded-0">
                    <div class="card-header bg-secondary rounded-0">
                        <div class="row text-right">
                            <div class="col-10 pr-0 select-customer">
                                <v-select  :options="customers" v-model="customer" label="name" placeholder="Search Customer"></v-select>
                            </div>
                            <div class="col-2 pl-0 mml-5">
                                <div class="form-group">
                                    <button class="btn btn-warning text-white btn-block" @click="createCustomer = true"> <i class="fa fa-plus"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0 text-right">
                        <div class="cart-products pr-2 pt-2 scroll-bar pb-2"  style="min-height: 51vh">
                            <div class="row bg-secondary text-white" v-if="carts.length > 0">
                                <div class="col-md-5 text-left pl-4">
                                    <span>{{lang.product_title}}</span>
                                </div>
                                <div class="col-md-7">
                                    <div class="float-left text-center w-90px">
                                        <span>{{lang.sell_price}}</span>
                                    </div>
                                    <div class="float-left text-center w-90px">
                                        <span>{{lang.tax}}</span>
                                    </div>

                                    <div class="float-left text-center w-80px">
                                        {{lang.qty}}
                                    </div>

                                    <div class="float-right text-center pr-4">
                                        {{lang.total}}
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row sell-item border-top pt-2 pb-2" v-for="(cart, key) in carts">
                                <div class="col-md-5 pl-3 text-left">
                                    <span class="product-title">{{cart.title}} </span>
                                </div>

                                <div class="col-md-7">
                                    <div class="float-left w-90px">
                                        <input type="number" v-model.number="cart.sell_price" step=".1" min=".1" value="10" class="form-control font-12 text-center" v-if="cart.price_type == 1" readonly>
                                        <input type="number" v-model.number="cart.sell_price" step=".1" min=".1" value="10" class="form-control font-12 text-center" v-if="cart.price_type == 2">
                                    </div>

                                    <div class="float-left w-90px">
                                        <input type="hidden" v-model="cart.tax_percentage = cart.tax.value">
                                        <input type="number" v-model.number="cart.tax_amount = cart.sell_price * cart.tax.value/ 100" step=".1" min=".1" value="10" class="form-control font-12 text-center" readonly>
                                    </div>

                                    <div class="float-left w-80px">
                                        <input type="number" v-model.number="cart.quantity" min="1" class="form-control font-12 text-center">
                                    </div>

                                    <div class="float-right">
                                        <input type="hidden" v-model.number="cart.total_price">
                                        <span class="price font-12"> <b>{{appConfig('app_currency')}}{{cart.total_price = cart.quantity * (parseInt(cart.sell_price) + parseInt(cart.tax_amount))}}</b></span>
                                        <a href="javascript:void(0)" class="mr-2 text-danger remove" @click="deleteProductFormCart(key)">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="cart-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table text-right  overflow-hidden">
                                        <tbody>
                                            <tr>
                                                <td>Total</td>
                                                <td width="30%"></td>
                                                <td width="30%" class="text-12">
                                                    <input type="number" v-model.number="summary.sub_total = subTotalotalCartsValue" class="form-control font-12" readonly>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Discount </td>
                                                <td></td>
                                                <td>
                                                    <input type="number" v-model="summary.discount" class="form-control font-12">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Grand Total</td>
                                                <td width="30%"></td>
                                                <td width="30%" class="text-12">
                                                    <input type="number" v-model.number="summary.grand_total = grandTotalotalCartsValue" class="form-control font-12" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <a href="javascript:void(0)" class="btn btn-primary btn-block btn-sm" @click="createPayment()">{{lang.payment}}</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card mb-2 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header bg-secondary rounded-0">
                        <div class="row w-104">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" v-model="filter.search" v-on:keyup.enter="onEnterClick" class="form-control" :placeholder="lang.product_search_kye">
                                </div>
                            </div>
                            <div class="col-md-8 p-0">
                                <div class="filter-category">
                                    <a href="javascript:void(0)" class="btn btn-outline-warning rounded-0 mt-1 mb-1" v-on:click="filter.category_id = ''">{{lang.all}}</a>
                                    <a href="javascript:void(0)" class="btn btn-outline-warning rounded-0 mr-1 mt-1 mb-1" v-for="category in categories" @click="productFilterByCategory(category.id)">{{category.title}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body card-body-all-products scroll-bar">
                        <div class="row justify-content-center all-products">
                            <div class="col-md-2 p-1" v-for="(product, index) in filteredProduct">
                                <div class="single-product" @click="addToCart(product.id)">
                                    <div class="img">
                                        <img :src="'../../'+product.thumbnail" class="img-fluid" v-if="product.thumbnail != null">
                                        <img :src="'../../images/default.png'" class="img-fluid" v-if="product.thumbnail == null">
                                    </div>
                                    <div class="description">
                                        <p class="product-title"><strong>{{product.title}}</strong></p>
                                        <div class="d-flex sku-price">
                                            <div class="col-12 pl-0 pt-0">
                                                <span>{{product.sku}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="price">$ {{product.sell_price}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="createCustomer" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="closeDrawer()">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Customer</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" v-model="new_customer.name" placeholder="Full Name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="text" v-model="new_customer.phone" placeholder="Phone Number" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" v-model="new_customer.email"  placeholder="Email Address" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" v-model.number="new_customer.address" placeholder="Address" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" @click="storeCustomer()">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="createPaymentDrawer" style="width: 70%">
            <button class="btn btn-primary btn-close" @click="closeCreatePaymentDrawer()">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.sell_details}}</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 border-right" style="height: 80vh">
                            <div v-if="carts.length > 0 && old_invoice == 1" class="mb-5">
                                <div class="row border-bottom pb-3 pt-3">
                                    <div class="col-md-12 text-center">
                                        <h2> {{lang.total}}: {{appConfig('app_currency')}}{{grandTotalotalCartsValue}}</h2>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-5">
                                        <strong>{{lang.paid}}:</strong>
                                    </div>
                                    <div class="col-md-7 pl-0  text-center">
                                        <input type="number" v-model.number="summary.paid_amount" class="form-control font-12" align="right">
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-5">
                                        <strong>{{lang.due}}:</strong>
                                    </div>
                                    <div class="col-md-7 pl-0  text-center">
                                        <input type="number" v-model="summary.due_amount = currentDue"  class="form-control font-12 text-danger" readonly>
                                    </div>
                                </div>

                                <div class="row mt-2" v-if="summary.change_amount > 0">
                                    <div class="col-md-5">
                                        <strong>{{lang.change}}:</strong>
                                    </div>
                                    <div class="col-md-7 pl-0  text-center">
                                        <input type="number" v-model="summary.change_amount" class="form-control font-12" align="right" readonly>
                                    </div>
                                </div>

                                <div class="row mt-4" v-if="cardInformationArea">
                                    <div class="col-md-12">
                                        <textarea v-model="summary.card_information"  class="form-control font-12" rows="3" placeholder="Card Information"></textarea>
                                    </div>
                                </div>


                                <div class="d-flex border-top border-bottom mt-4 pt-2 pb-2">
                                    <a href="javasctipt:void(0)" class="btn btn-secondary w-50" @click="paymentTypeCash">{{lang.cash}}</a>
                                    <a href="javasctipt:void(0)" class="btn btn-warning w-50" @click="paymentTypeCard">{{lang.card}}</a>
                                </div>

                                <div class="d-flex mt-2" v-if="summary.paid_amount != ''">
                                    <a href="javascript:void(0)" class="btn btn-primary btn-block" @click="updateSell()">{{lang.save_and_update}}</a>
                                </div>
                            </div>

                            <div class="row mt-5" v-if="invoicePrintBtn">
                                <div class="mt-5 pt-4 col-md-12">
                                    <a v-bind:href="'../../export/sell/print-invoice/id='+sell.id" @click="printInvoice" class="btn btn-warning btn-block mt-5" target="_blank">
                                        <i class="fa fa-print pt-2 pb-2 font-40"></i> <br>
                                        <strong>{{lang.print_invoice}}</strong>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 sell-invoice pl-4 pr-4 mt-2">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h2 class="company-name">{{appConfig('app_name')}}</h2>
                                    <p class="address">{{lang.address}}: {{appConfig('address')}}</p>
                                    <p class="vat">{{lang.var_reg_number}} : {{appConfig('vat_reg_no')}}</p>
                                    <p class="outlet">{{lang.outlet}}: {{my_branch.title}} </p>
                                </div>
                            </div>

                            <div class="row border-top" v-if="carts.length > 0 && old_invoice == 1">
                                <div class="col-md-12 border-bottom-dotted pb-1">
                                    <div class="d-flex pt-1 invoice-summary">
                                        <div class="col-6" v-if="">
                                            <div>
                                                <span>{{lang.customer_name}}:
                                                    {{customer.name}}
                                                </span>
                                            </div>
                                            <div class="mtm8">
                                                <span>{{lang.customer_phone}}: {{customer.phone}}</span>
                                            </div>
                                        </div>

                                        <div class="col-6 text-right">
                                            <div>
                                                <span>{{lang.invoice_id}}: {{sell.invoice_id}}</span>
                                            </div>
                                            <div class="mtm8">
                                                <span>{{lang.date}}: {{sell.sell_date}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row mb-4 mt-2">
                                        <div class="table-responsive sell-invoice-table">
                                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                                <thead>
                                                <tr class="bg-secondary text-white">
                                                    <th>{{lang.sl}}</th>
                                                    <th>{{lang.product_title}}</th>
                                                    <th>{{lang.price}}</th>
                                                    <th>{{lang.tax}}</th>
                                                    <th>{{lang.qty}}</th>
                                                    <th>{{lang.total}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr v-for="(cart, index) in carts">
                                                    <td>{{index + 1}}</td>
                                                    <td>{{cart.title}}</td>
                                                    <td>{{appConfig('app_currency')}}{{cart.sell_price}}</td>
                                                    <td>{{appConfig('app_currency')}}{{cart.tax_amount}} <sub>( {{cart.tax_percentage}}% )</sub></td>
                                                    <td>{{cart.quantity}}</td>
                                                    <td>{{appConfig('app_currency')}}{{(cart.sell_price + cart.tax_amount) * cart.quantity}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        {{lang.sub_total_price}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{summary.sub_total}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        (-) {{lang.discount}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{summary.discount}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        {{lang.net_payable}}
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{grandTotalotalCartsValue}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        <strong v-if="summary.payment_type == 1">{{lang.cash_paid}}: </strong>
                                                        <strong v-if="summary.payment_type == 2">{{lang.card_paid}}: </strong>
                                                    </td>
                                                    <td>
                                                        <strong>
                                                            {{appConfig('app_currency')}}{{summary.paid_amount}}
                                                        </strong>
                                                    </td>
                                                </tr>


                                                <tr v-if="summary.due_amount > 0">
                                                    <td colspan="5" class="text-right pr-5">
                                                        {{lang.due_amount}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{summary.due_amount}}
                                                    </td>
                                                </tr>

                                                <tr v-if="summary.change_amount > 0">
                                                    <td colspan="5" class="text-right pr-5">
                                                        {{lang.change_amount}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{summary.change_amount}}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row border-top" v-if="updatedInvoice">
                                <div class="col-md-12 border-bottom-dotted pb-1">
                                    <div class="d-flex pt-1 invoice-summary">
                                        <div class="col-6">
                                            <div>
                                                <span>{{lang.customer_name}}: {{updated_sell.customer.name}}</span>
                                            </div>
                                            <div class="mtm8">
                                                <span>{{lang.customer_phone}}: {{updated_sell.customer.phone}}</span>
                                            </div>
                                        </div>
                                        <div class="col-6 text-right">
                                            <div>
                                                <span>{{lang.invoice_id}}: {{updated_sell.invoice_id}}</span>
                                            </div>
                                            <div class="mtm8">
                                                <span>{{lang.date}}: {{sell.custome_sell_date}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row mb-4 mt-2">
                                        <div class="table-responsive sell-invoice-table">
                                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                                <thead>
                                                <tr class="bg-secondary text-white">
                                                    <th>{{lang.sl}}</th>
                                                    <th>{{lang.product_title}}</th>
                                                    <th>{{lang.price}}</th>
                                                    <th>{{lang.tax}}</th>
                                                    <th>{{lang.qty}}</th>
                                                    <th>{{lang.total}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr v-for="(sell_produt, index) in updated_sell.sell_products">
                                                    <td>{{index + 1}}</td>
                                                    <td>{{sell_produt.product.title}}</td>
                                                    <td>{{appConfig('app_currency')}}{{sell_produt.sell_price}}</td>
                                                    <td>{{appConfig('app_currency')}}{{sell_produt.tax_amount}} <sub>( {{sell_produt.tax_percentage}}% )</sub></td>
                                                    <td>{{sell_produt.quantity}}</td>
                                                    <td>{{appConfig('app_currency')}}{{(sell_produt.sell_price + sell_produt.tax_amount) * sell_produt.quantity}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        {{lang.sub_total_price}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{updated_sell.sub_total}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        (-) {{lang.discount}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{updated_sell.discount}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        {{lang.net_payable}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{updated_sell.grand_total_price}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" class="text-right pr-5">
                                                        <strong v-if="sell.payment_type == 1">{{lang.cash_paid}}: </strong>
                                                        <strong v-if="sell.payment_type == 2">{{lang.card_paid}}: </strong>
                                                    </td>
                                                    <td>
                                                        <strong>
                                                            {{appConfig('app_currency')}}{{updated_sell.paid_amount}}
                                                        </strong>
                                                    </td>
                                                </tr>


                                                <tr v-if="">
                                                    <td colspan="5" class="text-right pr-5">
                                                        {{lang.due_amount}}:
                                                    </td>
                                                    <td>
                                                        {{appConfig('app_currency')}}{{updated_sell.due_amount}}
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</template>

<script>
    export default {
        name: "EditSell",
        props : {
            sell : Object,
            all_categories : Array,
        },
        data() {
            return {
                lang: [],
                sell_details: Object,
                products: [],
                product: {},
                carts: [],
                categories: this.all_categories,
                category: {},
                customers: [],
                customer: null,
                configs: [],
                my_branch: [],
                updated_sell: [],
                new_customer: {
                    'name': '',
                    'phone': '',
                    'email': '',
                    'address': '',
                },
                summary:{
                    'sub_total': 0,
                    'discount': this.sell.discount,
                    'grand_total': this.sell.grand_total_price,
                    'payment': this.sell.paid_amount,
                    'due_amount': this.sell.due_amount,
                    'paid_amount': this.sell.paid_amount,
                    'change_amount': 0,
                    'payment_type': 1,
                    'card_information': '',
                },
                filter: {
                    search: '',
                    category_id: '',
                },
                createCustomer: false,
                printInvoice:false,
                createPaymentDrawer:false,
                invoicePrintBtn:false,
                cardInformationArea: false,
                updatedInvoice:false,
                old_invoice: 1,
            }
        },

        methods: {
            productFilterByCategory:function(category_id){
                this.filter.category_id = category_id;
            },

            onEnterClick: function() {
                this.products.forEach((product) => {
                    if (product.sku.toLowerCase() == this.filter.search.toLowerCase()){
                        this.addToCart(product.id);
                        this.filter.search = '';
                    }
                });
            },

            addToCart: function(product_id){
                if (this.isAlreadyInCart(product_id)) {
                    this.carts.forEach((cart) => {
                        if (cart.id == product_id) {
                            cart.quantity = cart.quantity + 1;
                        }
                    });
                }else {
                    this.products.forEach((product) => {
                        if (product.id == product_id) {
                            this.product = product;
                            this.product.quantity = 1;
                            this.carts.unshift(this.product);
                        }
                    });
                }
            },

            isAlreadyInCart: function (product_id) {
                let result = false;
                this.carts.forEach((element) => {
                    if (element.id == product_id) {
                        result = true
                    }
                });
                return result;
            },

            deleteProductFormCart: function (key) {
                this.carts.splice(key, 1)
            },

            createPayment:function(){
                if (this.sellStoreValidation()) {
                    if (this.carts.length != 0){
                        this.createPaymentDrawer = true;
                    }else {
                        toastr["error"]("!Empty Cart");
                    }
                }
            },

            paymentTypeCard: function() {
                this.cardInformationArea = true;
                this.summary.payment_type = 2;
            },

            paymentTypeCash: function() {
                this.cardInformationArea = false;
                this.summary.payment_type = 1;
            },

            updateSell:function(){
                if (this.sellStoreValidation()){
                    if (this.carts.length != 0){
                        axios.patch('../../sell/' + this.sell.id, {carts: JSON.parse(JSON.stringify(this.carts)), customer: JSON.parse(JSON.stringify(this.customer)), summary: this.summary}).then((response) => {
                            this.updated_sell = response.data.sell;
                            this.sell = this.updated_sell;
                            this.sell.custome_sell_date = response.data.sell_date;
                            this.old_invoice = 0;
                            this.updatedInvoice = true,
                            this.invoicePrintBtn = true;
                        }).catch((error) =>{
                            console.error(error);
                        });
                    }else {
                        toastr["error"]("!Empty Cart");
                        return false;
                    }
                }
            },

            closeCreatePaymentDrawer: function(){
                this.old_invoice = 1;
                this.createPaymentDrawer = false;
                this.invoicePrintBtn = false;
                this.sell = [];
            },

            newCustomer:function() {
                this.createCustomer = true;
            },

            storeCustomer:function(){
                if (this.customerValidation()){
                    axios.post('../../vue/api/store-customer', {new_customer: JSON.parse(JSON.stringify(this.new_customer))}).then((response) => {
                        this.customer = response.data;
                        this.customers.push(response.data);
                        this.new_customer.name = '';
                        this.new_customer.phone = '';
                        this.new_customer.email = '';
                        this.new_customer.address = '';
                        this.createCustomer = false;
                    }).catch((error) =>{
                        console.error(error);
                    });
                };
            },

            closeDrawer: function () {
                if (this.createCustomer == true) {
                    this.createCustomer = false;
                }
            },

            clearAll:function(){
                this.customer = null;
                this.carts = [];
                this.summary.sub_total = 0;
                this.summary.discount = 0;
                this.summary.grand_total = 0;
                this.summary.payment = 0;
                this.filter.search = '';
            },

            customerValidation:function () {
                let result = false;

                if (this.new_customer.name != ''){
                    result = true;
                }else{
                    toastr["error"]("Customer name is required");
                    result = false
                }

                if (this.new_customer.phone != ''){
                    result = true;
                }else{
                    toastr["error"]("Phone number is required");
                    result = false
                }

                this.customers.forEach((customer) => {
                    if (this.new_customer.phone != ''){
                        if (customer.phone == this.new_customer.phone) {
                            toastr["error"]("Phone number should be Unique");
                            this.new_customer.phone = '';
                            result = false
                        }else{
                            result = true;
                        }
                    }
                });

                return result;
            },

            sellStoreValidation:function () {
                if (this.customer != null){
                    return true;
                }else{
                    alert('Please select a Customer');
                    return false;
                }
            },

            appConfig: function (option_key) {
                let result;
                this.configs.forEach((element) => {
                    if (element.option_key == option_key) {
                        result = element.option_value;
                        return false;
                    }
                });

                return result;
            }
        },

        computed: {
            subTotalotalCartsValue(){
                this.carts.forEach((element, key) => {
                    axios.get('../../vue/api/product-available-stock-qty/' + element.id).then((response) => {
                        if (response.data == 0){
                            this.carts.splice(key, 1)
                        };
                        if (element.quantity > response.data) {
                            toastr["error"]("This quantity is not available");
                            element.quantity = response.data;
                        }
                    });
                });

                let total = 0;
                this.carts.forEach((cart) => {
                    total += cart.total_price;
                });
                return total;
            },

            grandTotalotalCartsValue(){
                let grand_total = parseInt(this.subTotalotalCartsValue)  - parseInt(this.summary.discount);
                return grand_total;
            },

            currentDue(){
                if(this.summary.paid_amount > this.grandTotalotalCartsValue){
                    this.summary.change_amount = parseInt(this.summary.paid_amount) - parseInt(this.grandTotalotalCartsValue);
                    return  0;
                }else{
                    this.summary.change_amount = 0;
                    return  parseInt(this.grandTotalotalCartsValue) - parseInt(this.summary.paid_amount);
                }
            },

            filteredProduct: function () {
                if (this.filter.category_id != ''){
                    return this.products.filter((product) => {
                        return product.category_id == (this.filter.category_id)
                            && (product.sku.toLowerCase().match(this.filter.search.toLowerCase()) || product.title.toLowerCase().match(this.filter.search.toLowerCase()));

                    });
                }

                if (this.filter.search != '') {
                    return this.products.filter((product) => {
                        return product.title.toLowerCase().match(this.filter.search.toLowerCase())
                            || product.sku.toLowerCase().match(this.filter.search.toLowerCase());

                    });
                }

                return this.products;
            },
        },

        beforeMount() {
            axios.get('../../vue/api/products').then((response) => {
                this.products = response.data;
            });

            axios.get('../../vue/api/sell-details/' + this.sell.id).then((response) => {
                this.sell_details = response.data;
                this.customer = this.sell_details.customer;
                this.sell_details.sell_products.forEach((sell_product) => {
                    sell_product.title = sell_product.product.title;
                    sell_product.id = sell_product.product.id;
                    sell_product.price_type = sell_product.product.price_type;
                    sell_product.tax = sell_product.product.tax;
                    this.carts.push(sell_product);
                });
            });

            axios.get('../../vue/api/get-app-configs').then((response) => {
                this.configs = response.data;
            });

            axios.get('../../vue/api/customers').then((response) => {
                this.customers = response.data;
            });

            axios.get('../../vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });

            axios.get('../../vue/api/my-branch').then((response) => {
                this.my_branch = response.data;
            });
        }
    }
</script>
