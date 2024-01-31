<template>
    <div class="container">
        <!-- Add Button -->
        <button class="btn btn-primary mt-5" style="float: right;" @click="openModal">Create User</button>
        <br> <br>
        <h2>User Lists</h2>

        <!-- Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Nationality</th>
                    <th>Date of birth</th>
                    <th>Education background</th>
                    <th>Mode of contact</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <tr v-if="userDatas" v-for="user in userDatas">
                        <td>
                            {{ user.name }}
                        </td>
                        <td>
                            {{ user.phone }}
                        </td>
                        <td>
                            {{ user.email }}
                        </td>
                        <td>
                            {{ user.address }}
                        </td>
                        <td>
                            {{ user.nationality }}
                        </td>
                        <td>
                            {{ user.dob }}
                        </td>
                        <td>
                            {{ user.education }}
                        </td>
                        <td>
                            {{ user.contact_mode }}
                        </td>
                </tr>
                <tr v-else >
                    <td colspan="8">
                        <div class="text-center">
                            No records found

                        </div>
                    </td>
                </tr>
                <!-- Table rows will be added dynamically here -->
            </tbody>
        </table>

        <div class="modal" tabindex="-1" role="dialog" :class="{ 'show': showModal, 'd-block': showModal }">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create User</h5>
                        <button type="button" class="close" @click="closeModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="submitForm">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" v-model="formData.name" class="form-control" required>
                                    <span v-if="!isNameValid" class="text-danger">Please enter a valid name.</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control"   v-model="formData.email" id="email">
                                    <span v-if="!isEmailValid" class="text-danger">Please enter a valid email.</span>

                                </div>
                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputAddress"  v-model="formData.address" placeholder="1234 Main St">
                                    <span v-if="!isAddressValid" class="text-danger">Please enter a valid address <address></address>.</span>

                                </div>
                                <div class="col-6">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob"  v-model="formData.dob">
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" v-model="formData.gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" v-model="formData.phone" placeholder="">
                                    <span v-if="!isPhoneValid" class="text-danger">Please enter a valid number .</span> <br>
                                    <span v-if="!isPhoneLengthValid" class="text-danger">Number must be of 10 digit .</span>

                                </div>
                                <div class="col-6">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <input type="text" class="form-control"  v-model="formData.nationality" id="nationality" placeholder="Nepalese">
                                </div>
                                <div class="col-6">
                                    <label for="education" class="form-label">Education Background</label>
                                    <input type="text" class="form-control"  v-model="formData.education" id="education" placeholder="BBA">
                                </div>
                                <div class="col-12">
                                    <label for="education" class="form-label">Mode of Contact</label>
                                    <select id="gender" v-model="formData.contact_mode" class="form-control">
                                        <option value="email">Email</option>
                                        <option value="phone">Phone</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>

                            </form>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Close</button>

                        <button type="button" class="btn btn-success" @click="create()">Create</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
export default {
    data: () => ({
        userDatas:[],
        showModal: false,
        formData: {
            name: '',
            gender: 'male',
            phone: '',
            email: '',
            address: '',
            nationality: '',
            dob: '',
            education: '',
            contact_mode: 'email',
        },
        isNameValid: true,
        isEmailValid: true,
        isAddressValid: true,
        isPhoneValid: true,
        isPhoneLengthValid: true,
    }),
    mounted(){
        this.getUser();
    },
    methods: {
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        create(){

            //Reset Validation Flag
            this.isNameValid = true;
            this.isEmailValid = true;
            this.isAddressValid = true;
            this.isPhoneValid = true;
            this.isPhoneLengthValid = true;

            //form validation
            if (!this.formData.name) this.isNameValid = false;
            if (!this.formData.email) this.isEmailValid = false;
            if (!this.formData.address) this.isAddressValid = false;
            if (!this.formData.phone) this.isPhoneValid = false;
            if(this.formData.phone.length !== 10) this.isPhoneLengthValid = false;
            if(this.isNameValid && this.isEmailValid && this.isAddressValid && this.isPhoneValid){
                console.log('here')
                axios.post('/create-user', this.formData).then((res) => {
                    if(res.status === 200){
                    toast.success("User created successfully !", {
                        autoClose: 1000,
                    }); //
                    this.resetForm();
                    this.showModal = false;
                    this.getUser();
                }
                });
            }
        },
        getUser(){
            axios.get('/get-user').then(({data})=>{
                this.userDatas = data.data
            })
        },
        resetForm(){
            this.formData.name= '';
            this.formData.email= '';
            this.formData.address= '';
            this.formData.dob= '';
            this.formData.gender= 'male';
            this.formData.phone= '';
            this.formData.nationality= '';
            this.formData.education= '';
            this.formData.contact_mode= 'email';
        }
    },
}
</script>

