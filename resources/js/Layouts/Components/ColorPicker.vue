<template>
  <div class="relative">
      <div
          ref="trigger"
          class="form-input w-full btn-height-default"
          @click.prevent="dropdownOpen = !dropdownOpen"
          :aria-expanded="dropdownOpen"
      >
          <div class="color-selected-div" :item-selected="selected" :style="{ backgroundColor: selected }"></div>
      </div>

      <transition
          enter-active-class="transition ease-out duration-100 transform"
          enter-from-class="opacity-0 -translate-y-2"
          enter-to-class="opacity-100 translate-y-0"
          leave-active-class="transition ease-out duration-100"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0"
      >
          <div
              v-show="dropdownOpen"
              ref="dropdown"
              @focusin="dropdownOpen = true"
              @focusout="dropdownOpen = false"
              class="color-items-div box-width-default box-height-default box-style-true"
          >
              <span
                  v-for="option in options"
                  :key="option.id"
                  class="color-item item-width-default item-height-default item-hover-true"
                  :tag="option.color"
                  :class="option.color === selected && 'border-2 border-gray-300'"
                  @click="selected = option.color; dropdownOpen = false"
                  :style="{ backgroundColor: option.color, color: option.color }"
              ></span>
          </div>

      </transition>


  </div>
</template>

<script>
import {ref, onMounted, onUnmounted} from 'vue'

export default {
    name: 'ColorPicker',
    props: ['color'],
    setup(props) {

        let selectedColor = props.color ? props.color : '#1e88e5';
        const dropdownOpen = ref(false)
        const trigger = ref(null)
        const dropdown = ref(null)
        const selected = ref(selectedColor)

        const options = ref([
            {
                id: 0,
                color: '#1e88e5'
            },
            {
                id: 1,
                color: '#7460ee'
            },
            {
                id: 2,
                color: '#26c6da'
            },
            {
                id: 3,
                color: '#2f3d4a'
            },
            {
                id: 4,
                color: '#e5ae0a'
            },
            {
                id: 5,
                color: '#dc3545'
            }
        ])

        // close on click outside
        const clickHandler = ({target}) => {
            if (!dropdownOpen.value || dropdown.value.contains(target) || trigger.value.contains(target)) return
            dropdownOpen.value = false
        }

        // close if the esc key is pressed
        const keyHandler = ({keyCode}) => {
            if (!dropdownOpen.value || keyCode !== 27) return
            dropdownOpen.value = false
        }

        onMounted(() => {
            document.addEventListener('click', clickHandler)
            document.addEventListener('keydown', keyHandler)
        })

        onUnmounted(() => {
            document.removeEventListener('click', clickHandler)
            document.removeEventListener('keydown', keyHandler)
        })

        return {
            dropdownOpen,
            trigger,
            dropdown,
            selected,
            options,
        }
    }
}
</script>
