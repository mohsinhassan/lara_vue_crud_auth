<template>
    <div>
        <h3 class="text-center">Add Developer</h3>
       <p v-if="errors.length" style="color:red;">
            <b>Please correct the following error(s):</b>
            <ul>
            <li v-for="error in errors">{{ error }}</li>
            </ul>
        </p>
        <p v-if="success!=''" style="color:gree;">
            <b>{{success}}</b>
        </p>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addDeveloper" enctype="multipart/form-data">
                    <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" v-model="developer.fname">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" v-model="developer.lname">
                         
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <!--input  type="email"  class="form-control" v-model="developer.email"-->
                        <input id="email" type="email" class="form-control" v-model="developer.email">
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
                        <label>Avatar</label>
                        <input type="file" class="form-control" v-on:change="onChange">
                       
                    </div>
                    <button class="btn btn-primary btn-block">Add Developer</button>
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
                success:'',
                errors: [],
            }
        },
        methods: {
             onChange(e) {
                this.file = e.target.files[0];
            },
            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            addDeveloper(e) {
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
                if (!this.file) {
                    this.errors.push('Avatar required.');
                }

                if (!this.developer.email) {
                    this.errors.push('Email required.');
                } else if (!this.validEmail(this.developer.email)) {
                    this.errors.push('Valid email required.');
                }

                //if (this.errors.length) {
                  //  return false;
                //}

                e.preventDefault();
                let existingObj = this;

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
                data.append('avatar',  this.file);

                this.axios.post('http://localhost:8000/api/developer/add', data, config)
                    .then(function (res) {
                        this.$router.push({name: 'home'});
                        this.$router.replace({name: 'home'});
                        console.log('res');
                        console.log(res);
                        if(res.data.success != "Done!")
                        {
                            res.errors.forEach(function(entry) {
                                console.log(entry);
                            });
                            
                        }else{
                            alert("Developer added successfully");
                            this.$router.replace({name: 'home'});
                            this.$router.push({name: 'home'});
                        }
                        
                        
                    });
                
            }
            
        },
        mounted() {
            console.log({router: this.$router});
        }
    }
</script>