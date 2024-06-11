<script setup>

import NavBarDesktop from "../components/atom/NavBarDesktop.vue";
import NavBarMobile from "../components/atom/NavBarMobile.vue";
import {onMounted, onUnmounted, ref} from "vue";
import {BREAKPOINTS} from "../constant/bootstrap-constants";

const props = defineProps({
  navigation: {type: Object, required: true}
})

const screenWidth = ref(0);
const screenHeight = ref(0);

onMounted(() => {
  handleResize();
  window.addEventListener("resize", handleResize);
});
onUnmounted(() => {
  window.removeEventListener("resize", handleResize);
});

const handleResize = () => {
  screenWidth.value = window.innerWidth;
  screenHeight.value = window.innerHeight;
};
</script>

<template>
  <NavBarDesktop v-if="screenWidth > BREAKPOINTS.MD" id="home" :navigation="navigation"/>
  <NavBarMobile v-else :navigation="navigation" :screenWidth="screenWidth"/>
</template>