<script setup>
const props = defineProps({
  title: {type: String, required: true}
})
</script>

<template>
  <div class="card shadow rounded-5 border-0 overflow-hidden">

    <div v-if="title" class="card-header bg-white border-0">
      <p class="fs-4 ps-4 py-2 m-0 fw-bold text-info">{{ title }}</p>
    </div>

    <div class="card-body">
      <div v-if="$slots.content1 || $slots.buttons1" class="row">
        <div v-if="$slots.content1" class="col-md-7 col-12 text-center align-self-center">
          <slot name="content1"/>
        </div>
        <div v-if="$slots.buttons1" class="col-md-5 col-12 d-flex flex-md-column text-center">
          <div class="mx-auto">
            <slot name="buttons1"/>
          </div>
        </div>
      </div>

      <div v-if="$slots.content2 || $slots.buttons2" class="bg-info-subtle w-100 my-3"
           style="height: 1px !important;"></div>

      <div v-if="$slots.content2 || $slots.buttons2" class="row">
        <div v-if="$slots.content2" class="col-md-7 col-12 text-center align-self-center">
          <slot name="content2"/>
        </div>
        <div v-if="$slots.buttons2" class="col-md-5 col-12 d-flex flex-md-column text-center">
          <div class="mx-auto mx-md-0">
            <slot name="buttons2"/>
          </div>
        </div>
      </div>

      <div v-if="$slots.content3 || $slots.buttons3" class="bg-info-subtle w-100 my-3"
           style="height: 1px !important;"></div>

      <div v-if="$slots.content3 || $slots.buttons3" class="row">
        <div v-if="$slots.content3" class="col-md-7 col-12 text-center align-self-center">
          <slot name="content3"/>
        </div>
        <div v-if="$slots.buttons3" class="col-md-5 col-12 d-flex flex-md-column text-center">
          <div class="mx-auto mx-md-0">
            <slot name="buttons3"/>
          </div>
        </div>
      </div>

      <div v-if="$slots.content4 || $slots.buttons4" class="bg-info-subtle w-100 my-3"
           style="height: 1px !important;"></div>

      <div v-if="$slots.content4 || $slots.buttons4" class="row">
        <div v-if="$slots.content4" class="col-md-7 col-12 text-center align-self-center">
          <slot name="content4"/>
        </div>
        <div v-if="$slots.buttons4" class="col-md-5 col-12 d-flex flex-md-column text-center">
          <div class="mx-auto mx-md-0">
            <slot name="buttons4"/>
          </div>
        </div>
      </div>

    </div>

    <div v-if="$slots.footer" class="card-footer bg-white border-0">
      <slot name="footer"/>
    </div>
  </div>
</template>