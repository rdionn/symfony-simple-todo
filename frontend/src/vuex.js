import axios from 'axios'

const axiosApi = axios.create({
  baseURL: '/api/todo'
})

export default {
  state() {
    return {
      otwTodo: [],
      completeTodo: []
    }
  },
  mutations: {
    setOtwTodo(state, otwTodo) {
      state.otwTodo = otwTodo
    },
    setCompleteTodo(state, completeTodo) {
      state.completeTodo = completeTodo
    }
  },
  actions: {
    getOtwTodo(context) {
      axiosApi.get('all', { params: { status: 'ON_PROGRESS' }}).then((apiData) => {
        let { status, data } = apiData.data

        if (status === 200) {
          context.commit('setOtwTodo', data)
        }
      }).catch((e) => console.log(e))
    },
    getCompleteTodo(context) {
      axiosApi.get('all', { params: { status: 'COMPLETE' }}).then((apiData) => {
        let { status, data } = apiData.data

        if (status === 200) {
          context.commit('setCompleteTodo', data)
        }
      }).catch((e) => console.log(e))
    },
    createTodo(context, data) {
      let formData = new FormData()

      Object.keys(data).forEach((key) => {
        formData.set(key, data[key])
      })

      axiosApi.post('create', formData).then((apiData) => {
        let { status, data } = apiData.data

        if (status === 200) {
          context.dispatch('getOtwTodo')
          context.dispatch('getCompleteTodo')
        }
      })
    },
    setCompleteTodo(context, todoId) {
      axiosApi.get('complete', { params: { id: todoId }}).then((apiData) => {
        let { status, data } = apiData.data

        if (status === 200) {
          context.dispatch('getOtwTodo')
          context.dispatch('getCompleteTodo')
        }
      })
    }
  }
}
