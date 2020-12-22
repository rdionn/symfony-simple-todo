<template>
  <div class="card shadow my-5">
    <h4 class="my-card-title">Todo Apps</h4>

    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-12">
            <router-view></router-view>
          </div>

          <div class="col-md-8 col-12 mt-0 mt-xs-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="otw-tab" data-toggle="tab" href="#otw" role="tab" aria-controls="otw" aria-selected="true">On Progress</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="complete-tab" data-toggle="tab" href="#complete" role="tab" aria-controls="profile" aria-selected="false">Complete</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="otw" role="tabpanel" aria-labelledby="otw-tab">
                <p v-if="otwTodo.length === 0" class="d-flex border-top border-bottom text-center">
                  No Todo Yet
                </p>
                <div v-else v-for="todo in otwTodo" :key="todo.id" class="d-flex flex-column border-top border-bottom py-2 mt-1">
                  <h6>{{ todo.name }}</h6>
                  <span class="text-muted">By <strong>{{ todo.userName }}</strong></span>
                  <p class="my-2">{{ todo.description }}</p>
                  <button @click="setCompleteTodo(todo.id)" class="btn btn-primary">Complete Todo !</button>
                </div>
              </div>

              <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                <p v-if="completeTodo.length === 0" class="d-flex border-top border-bottom text-center">
                  No Todo Yet
                </p>

                <div v-else v-for="todo in completeTodo" :key="todo.id" class="d-flex flex-column border-top border-bottom py-2 my-1">
                  <h6>{{ todo.name }}</h6>
                  <span class="text-muted">By <strong>{{ todo.userName }}</strong></span>
                  <p class="my-2">{{ todo.description }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  mounted() {
    this.getOtwTodo()
    this.getCompleteTodo()
  },
  methods: {
    ...mapActions({
      getOtwTodo: 'getOtwTodo',
      getCompleteTodo: 'getCompleteTodo',
      setCompleteTodo: 'setCompleteTodo'
    })
  },
  computed: {
    ...mapState({
      'otwTodo': (state) => state.otwTodo,
      'completeTodo': (state) => state.completeTodo
    })
  }
}

</script>
