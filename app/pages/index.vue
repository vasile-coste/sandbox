<template>
  <div class="bg-white min-h-full px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center">
    <div class="max-w-max mx-auto">
      <main class="sm:flex">
        <p class="text-4xl font-extrabold text-indigo-600 sm:text-5xl">Welcome!</p>
        <div class="sm:ml-6">
          <div class="sm:border-l sm:border-gray-200 sm:pl-6">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">A New Way to Learn</h1>
            <p class="mt-1 text-base text-gray-500">Enhance your skills, expand your knowledge and prepare for technical interviews.</p>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
<script>

export default {
  components: {
  },

  data() {
    return {
    }
  },

  fetch() {
  },

  computed: {
  },

  created(){
    // this.showNotif()
  },

  methods: {
    showNotif () {
      this.$notify({
        title: '',
        type: 'success ',
        text: 'Bine ai venit!'
      })
    }
  },
}
</script>

