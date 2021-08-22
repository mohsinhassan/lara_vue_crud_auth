<template>
    <div>
        <h3 class="text-center">All Developers</h3><br/>
        <div v-if="success != ''" class="alert alert-success">
            {{success}}
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile No.</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="developer in developers" :key="developer.id">
                <td>{{ developer.id }}</td>
                <td>{{ developer.fname }} {{ developer.lname }}</td>
                <td>{{ developer.email }}</td>
                <td>{{ developer.phone_number }}</td>
                <td>{{ developer.address }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editdev', params: { id: developer.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(developer.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                developers: [],
                success:false
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/developers')
                .then(response => {
                    this.developers = response.data;
                });
        },
        methods: {
            deleteBook(id) {
                this.axios
                    .delete(`http://localhost:8000/api/developer/delete/${id}`)
                    .then(response => {
                        let i = this.developers.map(item => item.id).indexOf(id); // find index of your object
                        this.developers.splice(i, 1)
                    });
            }
        }
    }
</script>