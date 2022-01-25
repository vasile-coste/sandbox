<template>
  <div class="w-screen h-screen flex justify-center items-center bg-gray-100">
    <div class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md">
      <UserIcon class="w-20 h-20" />
      <p class="mb-5 text-3xl uppercase text-gray-600">Login</p>
      <input
        v-model="form.email"
        type="email"
        name="email"
        class="mb-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none"
        autocomplete="off"
        placeholder="Email"
        required
      >
      <input
        v-model="form.password"
        type="password"
        name="password"
        class="mb-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none"
        autocomplete="off"
        placeholder="Password"
        required
      >
      <button
        class="bg-purple-600 hover:bg-purple-900 text-white font-bold p-2 rounded w-80"
        id="login"
        type="submit"
        @click="handleLogin"
      >
        Login
      </button>
    </div>
  </div>
</template>

<script>
import UserIcon from "../icons/UserIcon.vue";

export default {
  components: {
    UserIcon,
  },
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    async handleLogin() {
      if (!this.form.email || !this.form.password) {
        this.$notify({
          type: "error",
          title: "Error",
          text: "Please enter the email and password.",
        });

        return false;
      }

      try {
        const response = await axios.post("/login", this.form);

        this.$notify({
          type: response.data.type,
          title: "Success",
          text: response.data.message,
        });
        setTimeout(function () {
          window.location.href = "/";
        }, 500);
      } catch (error) {
        error.response.data.messages.forEach((message) => {
          this.$notify({
            type: error.response.data.type,
            title: "Error",
            text: message,
          });
        });
      }
    },
  },
  mounted() {
    console.log("Login component mounted.");
  },
};
</script>