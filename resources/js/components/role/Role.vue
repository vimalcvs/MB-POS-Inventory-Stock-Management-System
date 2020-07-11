<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{lang.roles}}</h6>
                        <a href="javascript:void(0)" @click="createRole = true" class="btn btn-secondary btn-sm rounded-0"><i class="fa fa-plus"></i> {{lang.create_role}}</a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th width="5%">{{lang.sl}}</th>
                                    <th>{{lang.role_name}}</th>
                                    <th width="7%">{{lang.action}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(role, index) in roles">
                                    <td>{{index + 1}}</td>
                                    <td>{{role.name}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0)" class="" @click="editRole(role.id)"><i class="fa fa-edit"></i> </a>
                                            <a href="javascript:void(0);" class="pl-3"   @click="deleteRole(role.id, index)"><i class="fa fa-trash text-danger"></i></a>
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

        <div class="drawer shadow right" v-if="createRole" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="createRole = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.create_role}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.role_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newRole.name" :placeholder="lang.role_name" class="form-control">
                                <span class="error" v-if="errors['role.name']">{{errors['role.name'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" @click="storeRole()">{{lang.save}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="drawer shadow right" v-if="editRoleDrower" style="width: 500px">
            <button class="btn btn-primary btn-close" @click="editRoleDrower = false">x</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{lang.update_role}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{lang.role_name}} <span class="text-danger">*</span></label>
                                <input type="text" autofocus v-model="newRole.name = role.name" :placeholder="lang.role_name" class="form-control">
                                <span class="error" v-if="errors['role.name']">{{errors['role.name'][0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-12 pull-right">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary btn-block" @click="updateRole()">{{lang.save}}</button>
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
            all_roles : Array,
        },
        data() {
            return {
                lang: [],
                errors: [],
                roles: this.all_roles,
                role: {},
                newRole: {
                    name: '',
                },
                createRole: false,
                editRoleDrower: false,
            }
        },

        methods: {
            storeRole: function () {
                axios.post('role', {role: JSON.parse(JSON.stringify(this.newRole))}).then((response) => {
                    console.log(response.data);
                    this.newRole.name = '';
                    this.createRole = false;
                    this.roles.unshift(response.data);
                    toastr["success"]("Role successfully added");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            editRole: function (id) {
                this.roles.forEach((element) => {
                    if (element.id == id) {
                        this.role = element;
                    }
                });
                this.editRoleDrower = true;
            },

            updateRole: function () {
                axios.patch('role/' + this.role.id , {role: JSON.parse(JSON.stringify(this.newRole))}).then((response) => {
                    this.newRole.name = '';
                    this.editRoleDrower = false;
                    this.role = {};
                    toastr["success"]("Role successfully updated");
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                });
            },

            deleteRole: function (id, index) {
                swal({
                    title: "Are you sure?",
                    text: "To deleted this Category",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        axios.delete('role/' + id).then((response) => {
                            this.roles.splice(index, 1);
                            toastr["error"]("Role has been deleted");
                        }).catch((error) =>{
                            console.error(error);
                        });
                    }
                });
            },

            roleValidationUpdate:function () {
                let result = false;

                if (this.newRole.name != ''){
                    this.roles.forEach((element) => {
                        if (this.role.id != element.id) {
                           if (element.name == this.newRole.name) {
                                toastr["error"]("Role name is already exist");
                                this.newRole.name = '';
                                this.role.name = '';
                                result = false
                            }else{
                                result = true;
                            }
                        }
                    });
                }else{
                    toastr["error"]("Role name is required");
                    result = false
                }


                return result;
            },
        },

        beforeMount() {
            axios.get('/vue/api/get-local-lang').then((response) => {
                this.lang = response.data;
            });
        }
    }
</script>
