<template>
  <div class="w-full">
    <div
      class="flex md:flex-row flex-col"
      v-if="task"
    >
      <div class="md:w-1/2 w-full max-height md:min-height-1/2 overflow-y-auto mb-4">
        <div class="w-full mb-3">
          <span class="font-medium text-xl mr-2">{{task.name}}</span>
          <span class="text-sm bg-green-500 text-white py-1 px-2 rounded-full">{{task.badge}}</span>
        </div>
        <div
          class="w-full task-content text-sm"
          v-html="task.content"
        ></div>
      </div>
      <div class="md:w-1/2 w-full max-height md:min-height-1/2 overflow-y-auto mb-1">
        <CodeEditor :task_id="task_id" />
      </div>
    </div>
    <div
      class="w-full md:min-height-1/2 mb-4 flex justify-center p-8"
      v-else
    >
      <div class="lds-dual-ring"></div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import CodeEditor from "~/components/globals/CodeEditor.vue";

export default {
  components: {
    CodeEditor,
  },

  data() {
    return {
      task: null,
    };
  },

  fetch() {},

  computed: {
    ...mapGetters({
      taskList: "taskList",
    }),
    task_id() {
      return this.$route.params.task;
    },
  },

  watch: {
    taskList: {
      handler() {
        this.handleTask();
      },
      deep: true,
    },
  },

  async created() {
    if (!this.$route.params.task) {
      this.handleNotFound();
    } else {
      this.handleTask(this.$route.params.task);
    }
  },

  methods: {
    handleNotFound() {
      this.$router.push({ name: "404" });
    },

    handleTask() {
      // load task
      const task = this.taskList.data ? this.taskList.data.find((task) => task.id == this.task_id) : null
      this.task = task ?? this.task;
    },
  },
};
</script>

