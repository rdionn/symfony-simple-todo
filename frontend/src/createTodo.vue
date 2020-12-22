<template>
  <ValidationObserver slim ref="form">
    <form>
      <div class="form-group">
        <label for="todoName">Todo Name</label>
        <ValidationProvider name="Todo Name" rules="required" v-slot="{ errors }">
          <input type="text" v-model="formData.name" class="form-control" id="todoName" aria-describedby="emailHelp" placeholder="Todo Name">
          <span class="text-danger">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>

      <div class="form-group">
        <label for="todoDesc">Description</label>

        <ValidationProvider name="Description" rules="required" v-slot="{ errors }">
          <textarea v-model="formData.desc" class="form-control" id="todoDesc" placeholder="Todo Description"></textarea>
          <span class="text-danger">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>

      <div class="form-group">
        <label for="todoStatus">Status</label>
        <select v-model="formData.status" class="form-control">
          <option value="COMPLETE">Complete</option>
          <option value="ON_PROGRESS">On Progress</option>
        </select>
      </div>

      <button @click.prevent="submitTodo" type="submit" class="btn btn-primary">Save Todo</button>
    </form>
  </ValidationObserver>
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
import { required } from 'vee-validate/dist/rules';
import { mapActions } from 'vuex'

extend('required', {
  ...required
})

export default {
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data() {
    return {
      formData: {
        name: '',
        desc: '',
        status: 'ON_PROGRESS'
      }
    }
  },
  methods: {
    async submitTodo() {
      let allValid = await this.$refs.form.validate({ silent: false })

      if (allValid) {
        this.saveTodo(this.formData)
        this.$router.go(-1)
      }
    },
    ...mapActions({
      'saveTodo': 'createTodo'
    })
  }
}
</script>
