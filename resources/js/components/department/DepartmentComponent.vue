<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{lang.departments}}</h6>
                        <a href="javascript:void(0)" @click="createDepartmentDrawer" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> {{lang.create_department}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center table-sm" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                        <th width="5%">{{lang.sl}}</th>
                                        <th>{{lang.department_name}}</th>
                                        <th width="7%">{{lang.action}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(department, index) in departments">
                                    <td>{{index + 1}}</td>
                                    <td>{{department.title}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0)" class="" @click="editDepartment(department.id)"><i class="fa fa-edit"></i> </a>
                                            <a href="javascript:void(0);" class="pl-3"   @click="deleteDepartment(department.id, index)"><i class="fa fa-trash text-danger"></i></a>
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

        <div class="drawer shadow right responsive-drawer" v-if="createDepartment">
            <button class="btn btn-primary btn-close" @click="createDepartment = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.create_department}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.department_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newDepartment.title" :placeholder="lang.department_name" class="form-control">
                                <span class="error" v-if="errors['department.title']">{{errors['department.title'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" @click="storeDepartment()">{{lang.save}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="editDepartmentDrower" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="editDepartmentDrower = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.update_department}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.department_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newDepartment.title = department.title" :placeholder="lang.department_name" class="form-control">
                                <span class="error" v-if="errors['department.title']">{{errors['department.title'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary btn-block" @click="updateDepartment()">{{lang.save}}</button>
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
            all_departments : Array,
        },

        data() {
            return {
                errors: [],
                lang: [],
                departments: this.all_departments,
                department: {},
                newDepartment: {
                    title: '',
                },
                createDepartment: false,
                editDepartmentDrower: false,
            }
        },

        methods: {
            createDepartmentDrawer: function(){
                this.errors = [];
                this.createDepartment = true
            },
            storeDepartment: function () {
                axios.post('department', {department: JSON.parse(JSON.stringify(this.newDepartment))}).then((response) => {
                    this.newDepartment.title = '';
                    this.createDepartment = false;
                    this.departments.unshift(response.data);
                    toastr["success"]("Department Successfully Added");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            editDepartment: function (id) {
                this.departments.forEach((element) => {
                    if (element.id == id) {
                        this.department = element;
                    }
                });
                this.errors = [];
                this.editDepartmentDrower = true;
            },

            updateDepartment: function () {
                axios.patch('department/' + this.department.id , {department: JSON.parse(JSON.stringify(this.newDepartment))}).then((response) => {
                    this.newDepartment.title = '';
                    this.editDepartmentDrower = false;
                    this.department = {};
                    toastr["success"]("Department Successfully Updated");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            deleteDepartment: function (id, index) {
                swal({
                    title: "Are you sure?",
                    text: "To deleted this Department",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        axios.delete('department/' + id).then((response) => {
                            this.departments.splice(index, 1);
                            toastr["success"]("Department Deleted");
                        }).catch((error) =>{
                            toastr["error"]('You can not delete this Department. Employee have this Department.');
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
