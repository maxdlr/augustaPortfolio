<script setup>
import {onMounted, onUnmounted, ref} from "vue";

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
  <header class="ms-md-5 text-md-start text-center">
    <a class="link-underline link-underline-opacity-0 cursor-pointer" href="#home">
      <h1 class="d-inline-block text-nowrap" style="font-size: clamp(30px, 4vw, 100px) !important;">
        <span class="fs-title text-primary">augusta</span>
        <span class="bg-info rounded-circle d-inline-block mx-2"
              style="width: 6% !important; aspect-ratio: 1/1 !important;"></span>
        <span class="fs-title text-primary">sarlin</span>
      </h1>
    </a>
    <div class="text-end text-md-start pe-5">
      <span class="fst-italic text-secondary" style="font-size: clamp(15px, 5vw, 30px) !important;">Freelance 🤙 from Lyon with ❤️</span>
    </div>
  </header>
</template>
