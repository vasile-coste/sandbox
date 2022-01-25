<template>
  <nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <button
            type="button"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none"
            aria-controls="mobile-menu"
            aria-expanded="false"
            @click="mainMenu = !mainMenu"
          >
            <MenuIcon :open="mainMenu" />
          </button>
        </div>
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex-shrink-0 flex items-center">
            <!-- logo -->
            <img
              class="block lg:hidden h-8 w-auto"
              src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
              alt="Workflow"
            >
            <img
              class="hidden lg:block h-8 w-auto"
              src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
              alt="Workflow"
            >
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <a
              v-for="url in menu"
              :key="url.name"
              :href="'/'+url.href"
              class="hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
              :class="url.href == current || (current == '/' && url.href == '') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500'"
            >
              {{ url.name }}
            </a>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <!-- Profile dropdown -->
          <div class="ml-3 relative">
            <div>
              <button
                type="button"
                class="bg-white rounded-full flex text-sm focus:outline-none"
                id="user-menu-button"
                aria-expanded="false"
                aria-haspopup="true"
                @click="userMenu = !userMenu"
              >
                <UserIcon class="h-8 w-8 rounded-full" />
              </button>
            </div>

            <div
              :class="userMenu ? '' : 'hidden'"
              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu-button"
              tabindex="-1"
            >
              <!-- Active: "bg-gray-100", Not Active: "" -->
              <a
                href="/profile"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                tabindex="-1"
                id="user-menu-item-0"
              >
                Profile
              </a>
              <a
                href="/logout"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                tabindex="-1"
                id="user-menu-item-2"
              >
                Sign out
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div
      class="sm:hidden"
      id="mobile-menu"
    >
      <div v-if="mainMenu" class="pt-2 pb-4 space-y-1">
        <a
          v-for="url in menu"
          :key="url.name"
          :href="'/'+url.href"
          class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700"
          :class="url.href == current || (current == '/' && url.href == '') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-500'"
        >
          {{ url.name }}
        </a>
      </div>
    </div>
  </nav>
</template>
<script>
import MenuIcon from "../icons/MenuIcon.vue";
import UserIcon from "../icons/UserIcon.vue";

export default {
  name: "NavMenu",
  components: {
    MenuIcon,
    UserIcon,
  },
  props: {
    current: String,
  },
  data() {
    return {
      mainMenu: false,
      userMenu: false,
      menu: [
        {
          href: "",
          name: "Home",
        },
        {
          href: "tasks",
          name: "Tasks",
        },
        {
          href: "task-tests",
          name: "Task Tests",
        },
        {
          href: "solutions",
          name: "Solutions",
        },
      ],
    };
  },
  mounted() {
    console.log(this.current);
  },
  methods: {},
};
</script>