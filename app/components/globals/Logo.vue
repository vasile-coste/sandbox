<template>
  <div class="inline mr-2 text-xl text-indigo-600 font-bold">
      <LogoIcon />
  </div>
</template>
<script>
import LogoIcon from "~/components/icons/LogoIcon.vue";

export default {
  name: "Logo",
  components: {
    LogoIcon,
  },
  
  props: {}
};
</script>