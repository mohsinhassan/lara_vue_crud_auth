// import AllBooks from './components/AllBooks.vue';
// import AddBook from './components/AddBook.vue';
// import EditBook from './components/EditBook.vue';


import AllDevelopers from './components/AllDevelopers.vue';
import AddDeveloper from './components/AddDeveloper.vue';
import EditDeveloper from './components/EditDeveloper.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllDevelopers
    },
    {
        name: 'adddev',
        path: '/adddev',
        component: AddDeveloper
    },
    {
        name: 'editdev',
        path: '/editdev/:id',
        component: EditDeveloper
    }
];