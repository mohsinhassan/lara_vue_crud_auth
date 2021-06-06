<template>
    <div>
        <h3 class="text-center">Edit Developer</h3>
        <div class="row justify-content-center">
        
            <div class="col-md-6">
            <p v-if="errors.length" style="color:red;">
                <b>Please correct the following error(s):</b>
                <ul>
                <li v-for="error in errors">{{ error }}</li>
                </ul>
            </p>
                <form @submit.prevent="updateDeveloper">
                
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" v-model="developer.fname">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" v-model="developer.lname">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" v-model="developer.email">
                    </div>
                    <div class="form-group">
                        <label>Phone No.</label>
                        <input type="text" class="form-control" v-model="developer.phone_number">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" v-model="developer.address">
                    </div>
                    <div class="form-group">
                        <img v-bind:src="this.developer.avatar" alt="Avatar" style="max-width:200px;" />
                        
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" class="form-control" v-on:change="onChange">
                    </div>
                    
                    <button class="btn btn-primary" v-on:change="updateDeveloper">Update Developer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                developer: {},
                file:'',
                 errors: [],
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/developer/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.developer = response.data;
                    console.log('response');
                    console.log(response.data);
                });
        },
        methods: {
            onChange(e) {
                this.file = e.target.files[0];
            },
            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            updateDeveloper(e) {

                 this.errors = [];

                if (!this.developer.fname) {
                    this.errors.push('First Name required.');
                }
                if (!this.developer.lname) {
                    this.errors.push('Last Name required.');
                }
                
                if (!this.developer.phone_number) {
                    this.errors.push('Phone required.');
                }
                if (!this.developer.address) {
                    this.errors.push('Address required.');
                }

                if (!this.developer.email) {
                    this.errors.push('Email required.');
                } else if (!this.validEmail(this.developer.email)) {
                    this.errors.push('Valid email required.');
                }

                if (this.errors.length) {
                    return false;
                }

                
                 e.preventDefault();

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let data = new FormData();
                data.append('fname', this.developer.fname);
                data.append('lname', this.developer.lname);
                data.append('email', this.developer.email);
                data.append('phone_number', this.developer.phone_number);
                data.append('address', this.developer.address);
                if(this.file !=''){
                    data.append('avatar',  this.file);
                } 
                

                this.axios
                    .post(`http://localhost:8000/api/developer/update/${this.$route.params.id}`,  data, config)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>