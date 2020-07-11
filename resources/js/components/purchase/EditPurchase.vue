<template>
    <div class="container-fluid pl-2 pr-2">
        <div class="row p-1">
            <div class="col-lg-4 purchase-products pr-0">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Purchase Product</h6>
                        <a href="javascript:void(0)" @click="chooseSupplier()" class="btn btn-warning btn-sm text-white">
                            {{supplier.company_name}} <i class="fa fa-pencil-alt"></i>
                        </a>
                    </div>
                    <div class="card-body border p-0">
                        <div class="selected-products scroll-bar" style="height: 52vh">
                            <div class="row item pb-3 pt-3" v-for="(cart, index) in carts">
                                <div class="col-md-3 text-center">
                                    <img :src="'../../'+cart.thumbnail" class="img-fluid" v-if="cart.thumbnail != null" height="50px">
                                    <img :src="'../../images/default.png'" class="img-fluid" v-if="cart.thumbnail == null" height="50px">

                                </div>

                                <div class="col-md-7 description pr-0 pt-1">
                                    <span class="product-details">{{cart.title}}</span>
                                    <br>
                                    <p>{{cart.quantity}} x {{cart.purchase_price}} = {{cart.total_price}}/=</p>
                                </div>

                                <div class="col-md-2 text-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <a href="javascript:void(0)" @click="setPriceAndQty(cart.id)" class="btn btn-primary rounded-0 btn-sm"><i class="fa fa-pencil-alt"></i> </a>
                                        <a href="javascript:void(0);" @click="deleteProductFormCart(index)" class="btn btn-danger rounded-0 btn-sm"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table text-right  overflow-hidden">
                                    <tbody>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td width="30%"></td>
                                        <td width="30%"><strong>
                                            <input type="number" v-model.number="summary.total_amount = totalCartsValue" class="form-control payment-box" readonly>
                                        </strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Paid Amount </td>
                                        <td></td>
                                        <td>
                                            <input type="number" v-model.number="summary.paid_amount" class="form-control payment-box">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Due Amount </td>
                                        <td></td>
                                        <td>
                                            <input type="number" v-model.number="summary.due_amount = currentDue" class="form-control payment-box" readonly>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <a href="javascript:void(0)" @click="updatePurchase()" class="btn btn-primary btn-block">Save & Update</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 all-products" >
                <div class="card shadow mb-4">
                    <div class="card-header pb-0 bg-secondary">
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
                    <div class="card-body scroll-bar">
                        <div class="row justify-content-center">
                            <div class="col-md-2 p-1 single-product" v-for="(product, index) in filteredProduct">
                                <div class="item" @click="setPriceAndQty(product.id)">
                                    <div class="img">
                                        <img :src="'../../'+product.thumbnail" class="img-fluid" v-if="product.thumbnail != null">
                                        <img :src="'../../images/default.png'" class="img-fluid" v-if="product.thumbnail == null">
                                    </div>
                                    <div class="description">
                                        <p class="product-title"><strong>{{product.title}}</strong></p>
                                        <div class="d-flex sku-price">
                                            <div class="col-12 pl-0 pt-0">
                                                <span>Sku : {{product.sku}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price"> {{product.sell_price}}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="drawer shadow right" v-if="setPrice" style="width: 800px">
            <button class="btn btn-primary btn-close" @click="closeDrawer()">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Set Price & Quantity</h6>
                </div>
                <div class=card-body>

                    <div class="selected-products">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Purchase Price <span class="text-danger">*</span></label>
                                    <input type="number" min="0" v-model.number="product.purchase_price" placeholder="Purchase Price" class="form-control" tabindex="-1">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity <span class="text-danger">*</span></label>
                                    <input min="0" type="number" v-model.number="product.quantity" placeholder="Quantity" class="form-control" autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Price <span class="text-danger">*</span></label>
                                    <input type="number" v-model.number="product.total_price = product.quantity * product.purchase_price" step=".01" placeholder="Sell Price" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-12 pull-right">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" @click="addToCart()">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="updatePriceAndQty" style="width: 800px">
            <button class="btn btn-primary btn-close" @click="updatePriceAndQty = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Price & Quantity</h6>
                </div>
                <div class=card-body>

                    <div class="selected-products">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Purchase Price <span class="text-danger">*</span></label>
                                    <input type="number" v-model.number="product.purchase_price" placeholder="Purchase Price" class="form-control" tabindex="-1">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity <span class="text-danger">*</span></label>
                                    <input type="number" v-model.number="product.quantity" placeholder="Quantity" class="form-control" autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Price <span class="text-danger">*</span></label>
                                    <input type="number" v-model.number="product.total_price = product.quantity * product.purchase_price" step=".01" placeholder="Sell Price" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-12 pull-right">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" @click="addToCart()">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="setSupplier" style="width: 400px">
            <button class="btn btn-primary btn-close" @click="closeDrawer()">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Select Supplier</h6>
                </div>
                <div class="card-body p-0">
                    <div class="form-group p-2">
                        <input type="text" v-model="filter.supplier_search" autofocus class="form-control" placeholder="Find Supplier by Name,Phone,Email">
                    </div>
                    <div class="list-group">
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action rounded-0"  v-for="supplier in filteredSuppler" @click="selectSuppler(supplier.id)" >
                            {{supplier.company_name}} , {{supplier.phone}}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="printInvoice" style="width: 800px">
            <button class="btn btn-primary btn-close" @click="printInvoice = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.purchase_details}}</h6>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a v-bind:href="'../../export/purchase/print-invoice/id='+purchase.id+'/type={print}'" @click="printInvoice = false" target="_blank" class="btn btn-warning rounded-0 btn-sm">
                            <i class="fa fa-print"></i> {{lang.print_invoice}}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12 sell-invoice">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h2 class="company-name">{{appConfig('app_name')}}</h2>
                                    <p class="address">{{lang.address}}: {{appConfig('address')}}</p>
                                    <p class="vat">{{lang.var_reg_number}} : {{appConfig('vat_reg_no')}}</p>
                                    <p class="outlet">{{lang.outlet}}: {{my_branch.title}} </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 border-bottom-dotted border-top-dotted pb-1 mb-2">
                            <div class="d-flex pt-1 invoice-summary font-12">
                                <div class="col-6">
                                    <div>
                                        <span>{{lang.suppler_name}}:
                                            {{purchase.supplier.company_name}}
                                        </span>
                                    </div>
                                    <div class="mtm8">
                                        <span>{{lang.phone_number}}: {{purchase.supplier.phone}}</span>
                                    </div>
                                </div>

                                <div class="col-6 text-right">
                                    <div>
                                        <span>{{lang.invoice_id}}: {{purchase.invoice_id}}</span>
                                    </div>
                                    <div class="mtm8">
                                        <span>{{lang.date}}: {{purchase.custom_purchase_date}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{lang.sl}}</th>
                                    <th>{{lang.product}}</th>
                                    <th>{{lang.purchase_price}}</th>
                                    <th>{{lang.quantity}}</th>
                                    <th>{{lang.total_price}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(purchase_product, index) in purchase.purchase_products">
                                    <td width="3%">{{index + 1}}</td>
                                    <td>
                                        {{purchase_product.product.title}}
                                    </td>
                                    <td>{{appConfig('app_currency')}}{{purchase_product.purchase_price}} </td>
                                    <td>{{purchase_product.quantity}} </td>
                                    <td>{{appConfig('app_currency')}}{{purchase_product.total_price}} </td>
                                </tr>

                                <tr>
                                    <td colspan="4" class="text-right pr-5">
                                        {{lang.total_amount}}:
                                    </td>
                                    <td>
                                        {{appConfig('app_currency')}}{{purchase.total_amount}}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" class="text-right pr-5">
                                        {{lang.paid_amount}}:
                                    </td>
                                    <td>
                                        {{appConfig('app_currency')}}{{purchase.paid_amount}}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="4" class="text-right pr-5">
                                        {{lang.due_amount}}:
                                    </td>
                                    <td>
                                        {{appConfig('app_currency')}}{{purchase.due_amount}}
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

</template>

<script>
    export default {
        name: "EditPurchase",
        props : {
            purchase : Object,
        },
        data() {
            return {
                configs: [],
                my_branch: [],
                lang: [],
                products: [],
                product: {},
                suppliers: [],
                supplier: Object,
                categories: [],
                brands: [],
                carts: [],
                summary:{
                    'total_amount': 0,
                    'paid_amount': this.purchase.paid_amount,
                    'due_amount': this.purchase.due_amount,
                },
                filter: {
                    search: '',
                    supplier_search: '',
                    category_id: '',
                },
                grand_total_price:0,
                setPrice: false,
                setSupplier: false,
                updatePriceAndQty: false,
                printInvoice:false
            }
        },

        methods: {
            productFilterByCategory:function(category_id){
                this.filter.category_id = category_id;
            },

            onEnterClick: function() {
                this.products.forEach((product) => {
                    if (product.sku.toLowerCase() == this.filter.search.toLowerCase()){
                        this.setPrice = true;
                        this.product = product;
                        this.filter.search = '';
                    }
                });
            },

            setPriceAndQty: function (product_id) {
                if (this.isAlreadyInCart(product_id)) {
                    this.products.forEach((product) => {
                        if (product.id == product_id) {
                            this.product = product;
                        }
                    });

                    this.carts.forEach((element) => {
                        if (element.id == product_id) {
                            this.product.purchase_price = element.purchase_price;
                            this.product.quantity = element.quantity;
                            this.product.total_price = element.total_price;
                        }
                    });
                    this.updatePriceAndQty = true;
                }else {
                    this.setPrice = true;
                    this.products.forEach((product) => {
                        if (product.id == product_id) {
                            this.product = product;
                        }
                    });
                }
            },

            addToCart: function(){
                if (this.isAlreadyInCart(this.product.id)) {
                    this.setPrice = false;
                    this.carts.forEach((element) => {
                        if (element.id == this.product.id) {
                            element.purchase_price = this.product.purchase_price;
                            element.quantity = this.product.quantity;
                            element.total_price = this.product.total_price;
                        }
                    });
                    this.updatePriceAndQty= false;
                }else {
                    this.carts.push(this.product);
                    this.setPrice = false;
                }
            },

            isAlreadyInCart: function (cart_product_id) {
                let result = false;
                this.carts.forEach((element) => {
                    if (element.id == cart_product_id) {
                        result = true
                    }
                });
                return result;
            },

            deleteProductFormCart: function (index) {
                this.carts.splice(index, 1)
            },

            chooseSupplier:function (){
                if (this.setPrice == true) {
                    this.setPrice = false;
                }
                this.setSupplier = true;
            },

            selectSuppler:function(supplier_id){
                this.setSupplier = false;
                this.suppliers.forEach((supplier) => {
                    if (supplier.id == supplier_id) {
                        this.supplier = supplier;
                    }
                });
            },

            updatePurchase:function(){
                if (this.carts.length != 0) {
                    axios.patch('../../purchase/' + this.purchase.id, {carts: JSON.parse(JSON.stringify(this.carts)), supplier: JSON.parse(JSON.stringify(this.supplier)), summary: JSON.parse(JSON.stringify(this.summary))}).then((response) => {
                        this.printInvoice = true;
                        this.purchase = response.data;
                        this.purchase.custom_purchase_date = response.data.custom_purchase_date;
                    }).catch((error) =>{
                        console.error(error);
                    });
                }else{
                    alert('Empty carts !');
                }
            },

            closeDrawer: function () {
                if (this.setPrice == true) {
                    this.setPrice = false;
                }
                if (this.setSupplier == true) {
                    this.setSupplier = false;
                }
            },

            clearAll:function(){
                this.supplier = Object;
                this.carts = [];
                this.summary.total_amount = 0;
                this.summary.paid_amount = 0;
                this.summary.due_amount = 0;
                this.summary.payment = 0;
                this.filter.search = '';
                this.filter.supplier_search = '';
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
            totalCartsValue(){
                let total = 0;
                this.carts.forEach((cart) => {
                    total += cart.total_price;
                });

                if (total == 0) {
                    total = this.purchase.total_amount;
                }

                return total;
            },

            currentDue(){
                if(this.summary.paid_amount > this.totalCartsValue){
                    this.summary.paid_amount = 0;
                }
                return  this.totalCartsValue - this.summary.paid_amount;
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

            filteredSuppler: function () {
                if (this.filter.supplier != '') {
                    return this.suppliers.filter((supplier) => {
                        return supplier.company_name.toLowerCase().match(this.filter.supplier_search.toLowerCase())
                            || supplier.phone.toLowerCase().match(this.filter.supplier_search.toLowerCase());
                    });
                }
                return this.suppliers;
            }
        },

        beforeMount() {
             axios.get('../../vue/api/products').then((response) => {
                this.products = response.data;
            });

             axios.get('../../vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });

             axios.get('../../vue/api/get-app-configs').then((response) => {
                this.configs = response.data;
            });

             axios.get('../../vue/api/categories').then((response) => {
                this.categories = response.data;
            });

             axios.get('../../vue/api/purchase-details/' + this.purchase.id).then((response) => {
                this.supplier = response.data.supplier;
                response.data.purchase_products.forEach((purchase_product) => {
                    purchase_product.title = purchase_product.product.title;
                    purchase_product.thumbnail = purchase_product.product.thumbnail;
                    purchase_product.id = purchase_product.product_id;
                    this.carts.push(purchase_product);
                });
            });

             axios.get('../../vue/api/suppliers').then((response) => {
                this.suppliers = response.data;
            });
             axios.get('../../vue/api/my-branch').then((response) => {
                this.my_branch = response.data;
            });
        }
    }
</script>
