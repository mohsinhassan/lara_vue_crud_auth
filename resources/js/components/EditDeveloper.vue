<template>
    <div>
        <h3 class="text-center">Edit Developer2</h3>
        <div class="row">
            <div class="col-md-6">
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
                file:''
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
            updateDeveloper(e) {
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