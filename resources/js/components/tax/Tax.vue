<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{lang.taxes}}</h6>
                        <a href="javascript:void(0)" @click="createTaxDeawer()" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> {{lang.create_tax}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th width="5%">{{lang.sl}}</th>
                                        <th>{{lang.tax_title}}</th>
                                        <th>{{lang.tax_value}}</th>
                                        <th width="8%">{{lang.action}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(tax, index) in taxes">
                                    <td>{{index + 1}}</td>
                                    <td>{{tax.title}}</td>
                                    <td>{{tax.value}} %</td>
                                    <td class="font-14">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0)" @click="editTax(tax.id)"><i class="fa fa-edit pr-3"></i> </a>
                                            <a href="javascript:void(0);"   @click="deleteTax(tax.id, index)"><i class="fa fa-trash text-danger"></i></a>
                                        </div>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right responsive-drawer" v-if="createTax">
            <button class="btn btn-primary btn-close" @click="createTax = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.create_tax}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.tax_title}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="new_tax.title" :placeholder="lang.tax_title" class="form-control">
                                <span class="error" v-if="errors['tax.title']">{{errors['tax.title'][0]}}</span>
                            </div>
                        </div>


                       <div class="col-md-12 mb-3">
                           <label>{{lang.tax_value}} <span class="text-danger">*</span></label>
                           <div class="input-group">
                               <input type="number" v-model:number="new_tax.value" :placeholder="lang.tax_value" min="0" max="100"  class="form-control">
                               <div class="input-group-append">
                                   <span class="input-group-text">%</span>
                               </div>
                           </div>
                           <span class="error" v-if="errors['tax.value']">{{errors['tax.value'][0]}}</span>
                       </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" @click="storeTax()">{{lang.save}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="editTaxDrawer" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="closeEditTaxDrawer()">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.update_tax}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.tax_title}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="new_tax.title = tax.title" :placeholder="lang.tax_title" class="form-control">
                                <span class="error" v-if="errors['tax.title']">{{errors['tax.title'][0]}}</span>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>{{lang.tax_value}} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" v-model:number="new_tax.value = tax.value" :placeholder="lang.tax_value" min="0" max="100"  class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <span class="error" v-if="errors['tax.value']">{{errors['tax.value'][0]}}</span>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary btn-block" @click="updateTax()">{{lang.save}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tax",
        props : {
            all_taxes : Array,
        },
        data() {
            return {
                lang: [],
                tax: {},
                taxes: this.all_taxes,
                new_tax: {
                    title: '',
                    value: null,
                },
                errors: [],
                createTax: false,
                editTaxDrawer: false,
            }
        },

        methods: {
            createTaxDeawer:function(){
               this.errors = [];
               this.createTax = true;
            },
            storeTax: function () {
                axios.post('tax', {tax: JSON.parse(JSON.stringify(this.new_tax))}).then((response) => {
                    this.new_tax.title = '';
                    this.new_tax.value = null;
                    this.createTax = false;
                    this.taxes.unshift(response.data);
                    toastr["success"]("Tax successfully added");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            editTax: function (id) {
                this.taxes.forEach((element) => {
                    if (element.id == id) {
                        this.tax = element;
                    }
                });
                this.errors = [];
                this.editTaxDrawer = true;
            },

            updateTax: function () {
                axios.patch('tax/' + this.tax.id , {tax: JSON.parse(JSON.stringify(this.new_tax))}).then((response) => {
                    this.new_tax.title = '';
                    this.new_tax.value = null;
                    this.editTaxDrawer = false;
                    this.tax = {};
                    toastr["success"]("Tax successfully updated");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            deleteTax: function (id, index) {
                swal({
                    title: "Are you sure?",
                    text: "To deleted this Tax",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        axios.delete('tax/' + id).then((response) => {
                            this.taxes.splice(index, 1);
                            toastr["error"]("Tax has been deleted");
                        }).catch((error) =>{
                            console.error(error);
                        });
                    }
                });
            },

            closeEditTaxDrawer:function () {
                this.editTaxDrawer = false;
                this.new_tax.title = '';
                this.new_tax.value = null;
            },
        },

        beforeMount() {
            axios.get('vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });
        }
    }
</script>
