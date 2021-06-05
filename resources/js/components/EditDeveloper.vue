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
                    
                    <button type="submit" class="btn btn-primary">Update Developer</button>
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
            updateDeveloper() {
                this.axios
                    .post(`http://localhost:8000/api/developer/update/${this.$route.params.id}`, this.developer)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>