<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{lang.designations}}</h6>
                        <a href="javascript:void(0)" @click="createDrower= true" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> {{lang.create_designation}} </a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="5%">{{lang.sl}}</th>
                                    <th>{{lang.designation_name}}</th>
                                    <th width="8%">{{lang.action}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(designation, index) in designations">
                                    <td>{{index + 1}}</td>
                                    <td>{{designation.title}}</td>
                                    <td class="font-14">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0)" class="mr-2" @click="editDesignation(designation.id)"><i class="fa fa-edit text-primary"></i> </a>
                                            <a href="javascript:void(0);" class=""   @click="deleteDesignation(designation.id, index)"><i class="fa fa-trash text-danger"></i></a>
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

        <div class="drawer shadow right responsive-drawer" v-if="createDrower">
            <button class="btn btn-primary btn-close" @click="createDrower = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.create_designation}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.designation_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newDesignation.title" :placeholder="lang.designation_name" class="form-control">
                                <span class="error" v-if="errors['designation.title']">{{errors['designation.title'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" @click="storeDesignation()">{{lang.save}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="editDrower" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="editDrower = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.update_designation}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.designation_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newDesignation.title = designation.title" :placeholder="lang.designation_name" class="form-control">
                                <span class="error" v-if="errors['designation.title']">{{errors['designation.title'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary btn-block" @click="updateDesignation()">{{lang.save}}</button>
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
        props : {
            all_designations : Array,
        },

        data() {
            return {
                errors: [],
                lang: [],
                designations: this.all_designations,
                designation: {},
                newDesignation: {
                    title: '',
                },
                createDrower: false,
                editDrower: false,
            }
        },

        methods: {
            storeDesignation: function () {
                axios.post('designation', {designation: JSON.parse(JSON.stringify(this.newDesignation))}).then((response) => {
                    this.newDesignation.title = '';
                    this.createDrower= false;
                    this.designations.unshift(response.data);
                    toastr["success"]("Designation Successfully Added");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            editDesignation: function (id) {
                this.designations.forEach((element) => {
                    if (element.id == id) {
                        this.designation = element;
                    }
                });
                this.editDrower = true;
            },

            updateDesignation: function () {
                axios.patch('designation/' + this.designation.id , {designation: JSON.parse(JSON.stringify(this.newDesignation))}).then((response) => {
                    this.newDesignation.title = '';
                    this.editDrower = false;
                    this.designation = {};
                    toastr["success"]("Designation Successfully Updated");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            deleteDesignation: function (id, index) {
                swal({
                    title: "Are you sure?",
                    text: "To deleted this Designation",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        axios.delete('designation/' + id).then((response) => {
                            this.designations.splice(index, 1);
                            toastr["success"]("Designation Deleted");
                        }).catch((error) =>{
                            toastr["error"]('You can not delete this Designation. Employee have this designation. ');
                        });
                    }
                });
            },

        },

        beforeMount() {
            axios.get('vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });
        }
    }
</script>
