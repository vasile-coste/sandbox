<template>
  <div class="w-full">
    <div
      v-if="lastPage > 0"
      :class="showPages ? '' : 'justify-between'"
      class="w-full inline-flex pt-4"
      aria-label="Pagination"
    >
      <button
        :disabled="currentPage === 1"
        :class="currentPage === 1 ? 'cursor-not-allowed text-gray-300' : 'text-gray-500'"
        class="
          border-gray-300
          inline-flex
          items-center
          px-4
          py-2
          border
          text-sm
          font-medium
          bg-white
          hover:bg-gray-50
          rounded-sm
        "
        @click="handleChangePage(currentPage - 1)"
      >
        <span class="sr-only">Previous</span>
        <PreviousIcon />
      </button>
      <span v-if="showPages">
        <span
          v-if="currentPage - displayPages > 1"
          class="border-gray-300 inline-flex items-center px-4 py-2 border text-sm font-medium"
        >
          ...
        </span>
        <button
          v-for="n in pageRanges"
          :key="n"
          :class="
            currentPage === n
              ? 'bg-pink-safari text-white font-medium'
              : 'bg-white text-gray-500 hover:bg-gray-50'
          "
          class="
            border-gray-300
            inline-flex
            items-center
            px-4
            py-2
            border
            text-sm
          "
          @click="handleChangePage(n)"
        >
          {{ n }}
        </button>
        <span
          v-if="currentPage + displayPages < lastPage"
          class="border-gray-300 inline-flex items-center px-4 py-2 border text-sm font-medium"
        >
          ...
        </span>
      </span>
      <button
        :disabled="currentPage === lastPage"
        :class="currentPage === lastPage ? 'cursor-not-allowed text-gray-300' : 'text-gray-500'"
        class="
          border-gray-300
          inline-flex
          items-center
          px-4
          py-2
          border
          text-sm
          font-medium
          bg-white
          hover:bg-gray-50
          rounded-sm
        "
        @click="handleChangePage(currentPage + 1)"
      >
        <span class="sr-only">Next</span>
        <NextIcon />
      </button>
    </div>
    <div class="flex justify-end text-sm text-gray-500 mt-1">Tasks: {{total}}</div>
  </div>
</template>

<script>
import PreviousIcon from "~/components/icons/PreviousIcon.vue";
import NextIcon from "~/components/icons/NextIcon.vue";

export default {
  components: {
    PreviousIcon,
    NextIcon,
  },
  props: {
    showPages: {
      type: Boolean,
      required: false,
      default: false,
      description: "Show all pages, not just next or prev",
    },
    displayPages: {
      type: Number,
      required: false,
      default: 3,
      description: "Pages to show",
    },
    pagination: {
      type: Object,
      default: () => {},
      required: true,
      description: "Pagination object from API",
    },
  },
  computed: {
    pageRanges() {
      const pages = [];
      const maxDisplay =
        this.pagination.current_page + this.displayPages >
        this.pagination.last_page
          ? this.pagination.last_page
          : this.pagination.current_page + this.displayPages;
      const startPages =
        this.pagination.current_page - this.displayPages < 1
          ? 1
          : this.pagination.current_page - this.displayPages;
      for (let i = startPages; i <= maxDisplay; i++) {
        pages.push(i);
      }

      return pages;
    },
    total() {
      return this.pagination.total;
    },
    lastPage() {
      return this.pagination.last_page;
    },
    currentPage() {
      return this.pagination.current_page;
    },
  },

  methods: {
    handleChangePage(page) {
      if (this.pagination.current_page === page) {
        return false;
      }

      this.$emit("handleChangePage", page);
    },
  },
};
</script>
