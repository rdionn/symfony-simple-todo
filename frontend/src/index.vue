<template>
  <div class="form-group">
    <button @click.prevent="createTodoClick" class="btn btn-primary btn-block mt-2">Create Todo</button>
    <button @click.prevent="logout" class="btn btn-danger btn-block mt-2">Logout</button>
  </div>
</template>

<script>
export default {
  methods: {
    createTodoClick() {
      this.$router.push('/create-todo')
    },
    logout() {
      if (confirm('Sure Logout ?')) {
        window.location = '/logout'
      }
    }
  }
}
</script>
