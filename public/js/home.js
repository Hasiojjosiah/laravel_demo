const app = new Vue({
    el: '#app',
    data: {
        id: parseInt(document.getElementById("user_id").value),
        todos: [],
        newTask: {
            task: "",
            date: moment().format('YYYY-MM-DD'),
        },

        editTask: {
            id: "",
            task: "",
            date: moment().format('YYYY-MM-DD'),
        }
    },
    mounted() {

        this.get();
    },
    methods: {
        update(x) {},
        destroy(x) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete(`/api/todo/${x}`).then(() => {
                        this.get();
                        Swal.fire(
                            'Deleted!',
                            'Todo has been deleted.',
                            'success'
                        )
                    }, (error) => {
                        Swal.fire(
                            'Opss!',
                            'Something went wrong, please try again later.',
                            'warning'
                        )
                    });
                }
            })
        },
        checked(x) {
            axios.put(`/api/todo/check/${x}`)
        },
        highlight(x) {
            return x ? 'text-decoration-line: line-through;' : '';
        },
        formatDate(x) {
            return moment(x).format("MMM Do YYYY")
        },
        modalToggleEdit(x) {
            this.editTask = x;
            this.editTask.date = moment(this.editTask.date).format('YYYY-MM-DD');
            $(`#edit-todo-modal`).modal('toggle');

        },
        modalToggleAdd() {
            $(`#add-todo-modal`).modal('toggle');
        },

        get() {
            axios.get(`/api/todos`).then((response) => {
                this.todos = response.data;
            });
        },
        store() {
            $("#add-todo-form :input").prop("disabled", true);
            $('.is-invalid').removeClass('is-invalid');
            axios.post(`/api/todo`, {
                task: this.newTask.task,
                date: this.newTask.date,
            }).then((response) => {
                    $("#add-todo-form :input").prop("disabled", false);
                    this.newTask.task = "";
                    this.newTask.date = moment().format('YYYY-MM-DD');
                    Toast.fire({
                        icon: 'success',
                        title: ' Todo Added!'
                    })
                    $('#add-todo-modal').modal('toggle');
                    this.get();
                },
                (error) => {
                    {
                        $("#add-todo-form :input").prop("disabled", false);
                        if (error.response.status) {
                            if (error.response.data.errors.date) {
                                $('#new-todo-date').addClass('is-invalid');
                                $('#new-todo-date').parent().find('span').find('strong').html(error.response.data.errors.date);
                            }
                            if (error.response.data.errors.task) {
                                $('#new-todo-task').addClass('is-invalid');
                                $('#new-todo-task').parent().find('span').find('strong').html(error.response.data.errors.task);
                            }
                        }

                    }
                })
        },
        update() {
            $("#edit-todo-form :input").prop("disabled", true);
            $('.is-invalid').removeClass('is-invalid');
            axios.put(`/api/todo`, {
                id: this.editTask.id,
                task: this.editTask.task,
                date: this.editTask.date,
            }).then((response) => {
                    $("#edit-todo-form :input").prop("disabled", false);
                    this.editTask.task = "";
                    this.editTask.date = moment().format('YYYY-MM-DD');
                    Toast.fire({
                        icon: 'success',
                        title: ' Todo Updated!'
                    })
                    $('#edit-todo-modal').modal('toggle');
                    this.get();
                },
                (error) => {
                    {
                        $("#edit-todo-form :input").prop("disabled", false);
                        if (error.response.status) {
                            if (error.response.data.errors.date) {
                                $('#edit-todo-date').addClass('is-invalid');
                                $('#edit-todo-date').parent().find('span').find('strong').html(error.response.data.errors.date);
                            }
                            if (error.response.data.errors.task) {
                                $('#edit-todo-task').addClass('is-invalid');
                                $('#edit-todo-task').parent().find('span').find('strong').html(error.response.data.errors.task);
                            }
                        }

                    }
                })
        }

    }
})