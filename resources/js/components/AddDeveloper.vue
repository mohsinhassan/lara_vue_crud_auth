<template>
    <div>
        <h3 class="text-center">Add Developer</h3>
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
                    <!--div class="form-group">
                        <img v-bind:src="this.developer.avatar" alt="Avatar" />
                        
                    </div-->
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" class="form-control" v-on:change="onChange(e)">
                    </div>
                    <button class="btn btn-primary btn-block" v-on:change="addDeveloper(e)">Add Developer</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                developer: {}
            }
        },
        methods: {
             onChange(e) {
                this.file = e.target.files[0];
            },
            addDeveloper(e) {
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

                axios.post('http://localhost:8000/api/developer/add', data, config)
                    .then(function (res) {
                        this.$router.push({name: 'home'})
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    })
                    .finally(() => this.loading = false)
                
            }
        }
    }
</script>