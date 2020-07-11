<template>
    <!-- Begin Page Content -->
    <div class="container-fluid pl-2 pr-2">
        <div class="row sell-pos">
            <div class="col-md-4 pr-0">
                <div class="card mb-2 rounded-0">
                    <div class="card-header bg-secondary rounded-0">
                        <div class="row text-right">
                            <div class="col-12 select-customer">
                                <v-select  :options="branches" v-model="branch" label="title" placeholder="Select Branch"></v-select>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0 text-right">
                        <div class="cart-products pr-2 pt-2 scroll-bar pb-2" style="min-height: 70vh">
                            <div class="row sell-item border-top pt-2 pb-2" v-for="(cart, key) in carts">
                                <div class="col-md-8 pl-4 text-left">
                                    <span class="product-title ">{{cart.title}} </span>
                                </div>

                                <div class="col-md-3">
                                    <div class="float-right">
                                        <input type="number" v-model.number="cart.quantity" min="1" class="form-control font-12 text-center">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <a href="javascript:void(0)" class="mr-2 text-danger remove" @click="deleteProductFormCart(key)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="cart-footer">
                            <div class="row">

                                <div class="col-md-12">
                                    <a href="javascript:void(0)" class="btn btn-primary btn-block btn-sm" @click="storeRequisition()">{{lang.send_requst}}</a>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <a href="javascript:void(0)" class="btn btn-danger btn-block btn-sm" @click="clearAll()">{{lang.clear}}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-2 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header bg-secondary rounded-0">
                        <div class="row w-100">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" v-model="filter.search" class="form-control" :placeholder="lang.product_search_kye">
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
                                        <img :src="'../'+product.thumbnail" class="img-fluid" v-if="product.thumbnail != null">
                                        <img :src="'../images/default.png'" class="img-fluid" v-if="product.thumbnail == null">
                                    </div>
                                    <div class="description">
                                        <p class="product-title"><strong>{{product.title}}</strong></p>
                                        <div class="d-flex sku-price">
                                            <div class="col-12 pl-0 pt-0">
                                                <span>Sku: {{product.sku}}</span>
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



        <div class="drawer shadow right" v-if="printInvoice" style="width: 1100px">
            <button class="btn btn-primary btn-close" @click="printInvoice = false">x</button>
            <div class="card shadow mb-4" v-if="requisition">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Requisition</h6>

                    <a v-bind:href="'../export/requisition/print-invoice/id='+requisition.id+'/type={print}'" target="_blank" class="btn btn-warning rounded-0 btn-sm">
                        <i class="fa fa-print"></i> {{lang.print}}
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">

                        <div class="col-md-12 sell-invoice mb-4 border-bottom">
                            <div class="row text-center">
                                <div class="col-md-12 pb-2">
                                    <h2 class="company-name">{{appConfig('app_name')}}</h2>
                                    <p class="address">{{lang.address}}: {{appConfig('address')}}</p>
                                    <p class="vat">{{lang.var_reg_number}} : {{appConfig('vat_reg_no')}}</p>
                                    <p class="outlet">{{lang.outlet}}: {{my_branch.title}} </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr class="bg-secondary text-white">
                                            <th colspan="2">{{lang.requisition_form}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{lang.branch}}</td>
                                                <td>{{requisition.requisition_from.title}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{lang.phone_number}}</td>
                                                <td>{{requisition.requisition_from.phone}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{lang.address}}</td>
                                                <td>{{requisition.requisition_from.address}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-4"></div>


                                <div class="col-md-4">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr class="bg-secondary text-white">
                                            <th colspan="2">{{lang.requisition_to}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{lang.branch}}</td>
                                                <td>{{requisition.requisition_to.title}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{lang.phone_number}}</td>
                                                <td>{{requisition.requisition_to.phone}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{lang.address}}</td>
                                                <td>{{requisition.requisition_to.address}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th>{{lang.sl}}</th>
                                        <th>{{lang.product}}</th>
                                        <th>{{lang.quantity}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(requisition_product, index) in requisition.requisition_products">
                                        <td width="3%">{{index + 1}}</td>
                                        <td> {{requisition_product.product.title}} </td>
                                        <td>{{requisition_product.quantity}} </td>
                                    </tr>
                                </tbody>
                            </table>
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
        data() {
            return {
                lang: [],
                requisition: [],
                products: [],
                product: {},
                carts: [],
                branches: [],
                my_branch: [],
                branch: {},
                filter: {
                    search: '',
                },
                printInvoice:false
            }
        },

        methods: {
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

            storeRequisition:function(){
                if (this.requisitionStoreValidation()){
                    if (this.carts.length != 0){
                        axios.post('../vue/api/store-requisition', {carts: JSON.parse(JSON.stringify(this.carts)), branch: JSON.parse(JSON.stringify(this.branch))}).then((response) => {
                            this.requisition = response.data;
                            this.clearAll();
                            this.printInvoice = true;
                        }).catch((error) =>{
                            console.error(error);
                        });
                    }else {
                        alert('!Empty Cart')
                    }
                }
            },

            clearAll:function(){
                this.branch = {};
                this.carts = [];
                this.filter.search = '';
            },

            requisitionStoreValidation:function () {
                if (this.branch != null){
                    return true;
                }else{
                    alert('Please select a Branch');
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
            filteredProduct: function () {
                if (this.filter.product != '') {
                    return this.products.filter((product) => {
                        return product.title.toLowerCase().match(this.filter.search.toLowerCase()) || product.sku.toLowerCase().match(this.filter.search.toLowerCase());
                    });
                }
                return this.products;
            }
        },

        beforeMount() {
            axios.get('../vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });

            axios.get('../vue/api/products').then((response) => {
                this.products = response.data;
            });

            axios.get('../vue/api/branches-without-me').then((response) => {
                this.branches = response.data;
                this.branch = null;
            });

            axios.get('../vue/api/get-app-configs').then((response) => {
                this.configs = response.data;
            });

            axios.get('../vue/api/my-branch').then((response) => {
                this.my_branch = response.data;
            });
        }
    }
</script>
