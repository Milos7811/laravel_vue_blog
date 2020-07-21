<template>
  <div
    class="image-slider-wrapper"
    v-if="sliderImages && showSlider"
    @keydown.esc="showSlider = false"
  >
    <div class="background"></div>
    <div class="image-wrapper-preview">
      <a
        href="#"
        @click.prevent="(showSlider = false), resetData()"
        class="close-icon"
      >
        x
      </a>
      <transition :name="sliderType" mode="out-in">
        <div class="image-wrapper" v-for="i in [currentIndex]" :key="i">
          <img
            class="image"
            :src="currentImg.post_image_path"
            v-on:load="onLoaded"
            v-show="loaded"
          />
        </div>
      </transition>
      <a class="prev" @click.prevent="prev" href="#">&#10094; </a>
      <a class="next" @click.prevent="next" href="#">&#10095; </a>
    </div>
  </div>
</template>
<script>
export default {
  name: "Slider",
  data() {
    return {
      showSlider: true,
      timer: null,
      currentIndex: 0,
      clickedImage: "",
      sliderImages: "",
      sliderType: "",
      loaded: false
    };
  },

  mounted() {
    this.$root.$on("slider-images", data => {
      this.sliderImages = data.images;
      this.clickedImage = data.activeImage;
      this.showSlider = true;
      this.choseActiveImage();
    });
  },

  methods: {
    onLoaded() {
      this.loaded = true;
    },
    choseActiveImage() {
      this.sliderImages.forEach((element, index) => {
        if (element.id == this.clickedImage.id) {
          this.currentIndex = index;
        }
      });
    },
    resetData() {
      (this.sliderImages = []), (this.images = "");
    },
    startSlide: function() {
      this.timer = setInterval(this.next, 4000);
    },

    next: function() {
      this.currentIndex += 1;
      this.sliderType = "next";
    },
    prev: function() {
      this.currentIndex -= 1;
      this.sliderType = "prev";
    }
  },

  computed: {
    currentImg: function() {
      return this.sliderImages[
        Math.abs(this.currentIndex) % this.sliderImages.length
      ];
    }
  }
};
</script>

<style lang="scss" scoped>
.close-icon {
  color: white;
  font-size: 30px;
  position: absolute;
  right: 10px;
  cursor: pointer;
  transition: none;
  user-select: none;
  z-index: 20;
  &:hover {
    color: darken(white, 20%);
  }
}
.background {
  width: 100%;
  height: 100%;
  background-color: black;
  opacity: 0.9;
}
.image-wrapper-preview {
  width: 600px;
  height: 600px;
  position: absolute;
  margin-top: 15%;
  overflow: hidden;
}
.image-slider-wrapper {
  width: 100vw;
  height: 100vw;
  position: fixed;
  top: 0px;
  left: 0px;
  display: flex;
  justify-content: center;
}
.image-slider {
  width: 600px;
  height: 600px;
  position: absolute;
  left: 25%;
  top: 25%;
}
.image-wrapper {
  width: 600px;
  height: auto;
  .image {
    width: 100%;
    height: auto;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
  }
}
.next-enter-active,
.next-leave-active {
  transition: all 0.4s ease-in-out;
  //   opacity: 1;
}

.next-enter {
  transform: translateX(-100%);
}
.next-enter-to,
.next-leave {
  transform: translateX(0%);
}
.next-leave-to {
  transform: translateX(100%);
}

.prev-enter-active,
.prev-leave-active {
  transition: all 0.4s ease-in-out;
  //   opacity: 1;
}

.prev-enter {
  transform: translateX(100%);
}
.prev-enter-to,
.prev-leave {
  transform: translateX(0%);
}
.prev-leave-to {
  transform: translateX(-100%);
}

img {
  height: 600px;
  width: 100%;
}

.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 30%;
  width: auto;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.7s ease;
  border-radius: 0 4px 4px 0;
  text-decoration: none;
  user-select: none;
}

.next {
  right: 0;
}

.prev {
  left: 0;
}

.prev:hover,
.next:hover {
  color: darken(white, 20%);
}
</style>
