<template>
  <div class="flex flex-col md:flex-row">
    <notifications
      position="top right"
      animation-type="velocity"
    />
    <div class="md:hidden w-full p-2 pb-0">
      <button @click="showMenu = !showMenu">
        <MenuIcon :open="showMenu" />
      </button>
    </div>
    <div :class="[showMenu ? 'sm:flex xs:flex' : '', 'fixed top-0 left-0 z-10 flex-col hidden w-64 md:relative md:flex md:flex-col h-screen bg-gray-100']">
      <div class="flex-1 flex flex-col">
        <div class="flex items-center p-2 border-b border-gray-300 justify-between">
          <Logo />
          <button
            class="md:hidden"
            @click="showMenu = !showMenu"
          >
            <MenuIcon :open="showMenu" />
          </button>
        </div>
        <nav
          v-if="navigation.length"
          class="flex-1 px-2 space-y-1 mt-2 overflow-y-auto flex flex-col"
          aria-label="Sidebar"
        >
          <input
            class="w-full my-1 p-1 border-solid border border-gray-400 rounded-sm text-sm focus:ring-0 focus:border-indigo-600"
            type="search"
            v-model="search"
            placeholder="Search..."
          >
          <nuxt-link
            v-for="item in navigation"
            :key="item.name"
            :to="item.task ? { name: item.route, params: { task: item.task } } : { name: item.route }"
            :class="[routeName === item.route && !task_id || task_id == item.task ? 'bg-indigo-500 text-gray-50' : 'text-gray-900', 'flex w-full text-left hover:bg-indigo-500 hover:text-gray-50 px-2 py-2 text-sm font-medium rounded-sm']"
          >
            {{ item.name }}
          </nuxt-link>
          <Pagination
            :pagination="taskList"
            class="inline"
            @handleChangePage="handleMenu"
          />
        </nav>
        <div v-else class="flex justify-center p-4">
          <div class="lds-dual-ring"></div>
        </div>
      </div>
      <div class="flex-shrink-0 flex border-t border-gray-300 p-2 mt-4">
        <div class="flex-shrink-0 w-full group block">
          <div class="flex items-center">
            <div>
              <UserIcon class="inline-block h-9 w-9 rounded-full" />
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                Vasile Coste
              </p>
              <a
                href="#"
                class="text-xs font-medium text-gray-500 group-hover:text-gray-700"
              >
                View profile
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col w-full">
      <div class="p-2 w-full">
        <Nuxt />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import MenuIcon from "~/components/icons/MenuIcon.vue";
import UserIcon from "~/components/icons/UserIcon.vue";
import Logo from "~/components/globals/Logo.vue";
import Pagination from "~/components/globals/Pagination";

export default {
  components: {
    MenuIcon,
    UserIcon,
    Logo,
    Pagination,
  },

  data() {
    return {
      showMenu: false,
      ipp: 15,
      search: null,
    };
  },

  computed: {
    ...mapGetters({
      navigation: "nav",
      taskList: "taskList",
    }),
    routeName() {
      return this.$route.name;
    },
    task_id() {
      return this.$route.params.task;
    },
  },

  watch: {
    search: {
      handler(val) {
        if (val.length > 2 || val.length === 0) {
          this.handleMenu(1);
        }
      },
      deep: true,
    },
  },

  mounted() {
    this.handleMenu(1);
  },

  methods: {
    async handleMenu(page) {
      const payload = {
        ipp: this.ipp,
        page: page,
        search: this.search,
      };
      try {
        await this.$store.dispatch("getTaskList", payload);
      } catch (error) {
        error.response.data.messages.forEach((msg) => {
          this.$notify({
            title: "",
            type: error.response.data.type,
            text: msg,
          });
        });
      }
    },
  },
};
</script>