export const state = () => ({
  task: {},
  taskList: {},
  nav: [],
})


export const getters = {
  task: state => state.task,
  taskList: state => state.taskList,
  nav: state => state.nav,
}
export const mutations = {
  setTask (state, task) {
    state.task = task
  },
  setTaskList (state, taskList) {
    state.taskList = taskList
  },
  setNav (state, nav) {
    state.nav = nav
  }
}

export const actions = {
  async saveSolution ({ commit }, payload) {
    try {
      const req = await this.$axios.post(`s/save`, payload)
      return Promise.resolve(req)
    } catch (error) {
      return Promise.reject(error)
    }
  },
  async getSolutions ({ commit }, task_id) {
    try {
      const req = await this.$axios.get(`s/all/${task_id}`)
      return Promise.resolve(req)
    } catch (error) {
      return Promise.reject(error)
    }
  },
  async getTaskList ({ commit }, payload) {
    try {
      const req = await this.$axios.post(`t/list`, payload)
      const nav = [{ name: "Home", route: "index" }]
        .concat(
          req.data.data.data.map(item => {
            return { name: item.name, route: "p-task", task: item.id }
          })
        )
      await commit('setNav', nav)
      await commit('setTaskList', req.data.data)
      return Promise.resolve(req)
    } catch (error) {
      return Promise.reject(error)
    }
  },
  async runCode ({ commit }, payload) {
    try {
      const req = await this.$axios.post(`s/run`, payload)
      return Promise.resolve(req)
    } catch (error) {
      return Promise.reject(error)
    }
  },
}