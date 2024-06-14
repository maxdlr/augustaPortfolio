<script setup>
const props = defineProps({
  title: {type: String, required: true},
  cols: {type: Array, default: [7, 5], required: false},
  columns: {type: Boolean, default: true, required: false}
})
</script>

<template>
  <div class="card shadow rounded-5 border-0 overflow-hidden" style="max-width: 100% !important;">

    <div v-if="title" class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
      <p class="fs-4 ps-4 py-2 m-0 fw-bold text-info">{{ title }}</p>
      <slot name="headerButton"/>
    </div>

    <div class="card-body">
      <div v-if="$slots.content1 || $slots.buttons1"
           :class="columns ? 'row' : 'd-flex flex-column-reverse justify-content-start align-items-start'">
        <div v-if="$slots.content1" :class="columns ? `col-lg-${cols[0]} col-12` : ''"
             class="text-center align-self-center">
          <slot name="content1"/>
        </div>
        <div v-if="$slots.buttons1" :class="columns ? `col-lg-${cols[1]} col-12` : ''"
             class="d-flex flex-lg-column text-center">
          <div class="mx-auto">
            <slot name="buttons1"/>
          </div>
        </div>
      </div>

      <div v-if="$slots.content2 || $slots.buttons2" class="bg-info-subtle w-100 my-3"
           style="height: 1px !important;"></div>

      <div v-if="$slots.content2 || $slots.buttons2"
           :class="columns ? 'row' : 'd-flex flex-column column-reverse justify-content-start align-items-start'">
        <div v-if="$slots.content2" :class="columns ? `col-lg-${cols[0]} col-12` : ''"
             class="text-center align-self-center">
          <slot name="content2"/>
        </div>
        <div v-if="$slots.buttons2" :class="columns ? `col-lg-${cols[1]} col-12` : ''"
             class="d-flex flex-lg-column text-center">
          <div class="mx-auto mx-lg-0">
            <slot name="buttons2"/>
          </div>
        </div>
      </div>

      <div v-if="$slots.content3 || $slots.buttons3" class="bg-info-subtle w-100 my-3"
           style="height: 1px !important;"></div>

      <div v-if="$slots.content3 || $slots.buttons3"
           :class="columns ? 'row' : 'd-flex flex-column column-reverse justify-content-start align-items-start'">
        <div v-if="$slots.content3" :class="columns ? `col-lg-${cols[0]} col-12` : ''"
             class="text-center align-self-center">
          <slot name="content3"/>
        </div>
        <div v-if="$slots.buttons3" :class="columns ? `col-lg-${cols[1]} col-12` : ''"
             class="d-flex flex-lg-column text-center">
          <div class="mx-auto mx-lg-0">
            <slot name="buttons3"/>
          </div>
        </div>
      </div>

      <div v-if="$slots.content4 || $slots.buttons4" class="bg-info-subtle w-100 my-3"
           style="height: 1px !important;"></div>

      <div v-if="$slots.content4 || $slots.buttons4"
           :class="columns ? 'row' : 'd-flex flex-column column-reverse justify-content-start align-items-start'">
        <div v-if="$slots.content4" :class="`col-lg-${cols[0]}`" class="col-12 text-center align-self-center">
          <slot name="content4"/>
        </div>
        <div v-if="$slots.buttons4" :class="`col-lg-${cols[1]}`" class="col-12 d-flex flex-lg-column text-center">
          <div class="mx-auto mx-lg-0">
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