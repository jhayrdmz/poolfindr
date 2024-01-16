<script setup lang="ts">
definePageMeta({
  layout: "main",
});

useHead({ title: "Poolfindr" });

/***
 * data
 */
const bookmark = ref<boolean>(false);
</script>

<template>
  <div id="page-home">
    <div class="py-10">
      <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-5 gap-x-7 gap-y-12">
          <div v-for="n in 10" :key="n" class="space-y-2 cursor-pointer">
            <div class="xl:h-[230px] rounded-2xl overflow-hidden relative">
              <div
                class="absolute top-2 left-2 bg-white text-primary text-xs px-3 py-1 rounded-full"
              >
                Most Popular
              </div>
              <UtilsImage
                :src="`https://picsum.photos/id/${n + 100}/500/500`"
                alt="Image"
                error-image-size="w-14 h-14"
                spinner-size="w-14 h-14"
              />
            </div>
            <div class="space-y-2">
              <div class="flex justify-between">
                <div class="flex-1 pr-5 truncate">
                  <h3 class="font-medium truncate">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Delectus explicabo cumque itaque recusandae inventore
                    labore, amet, soluta aliquam repudiandae tenetur dolorem
                    odio similique neque. Repellendus culpa error perspiciatis
                    est dolor.
                  </h3>
                  <p class="text-sm truncate text-gray-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Aliquam nihil voluptatum earum, esse nobis aut inventore
                    numquam modi cupiditate exercitationem cum nostrum dolores
                    id aliquid dolorum iste odit sunt quaerat.
                  </p>
                </div>
                <div>
                  <UtilsIcon
                    v-if="bookmark"
                    :icon="Icons.Bookmark"
                    class="w-5 h-5 text-accent"
                    @click="bookmark = !bookmark"
                  />
                  <UtilsIcon
                    v-else
                    :icon="Icons.BookmarkOutline"
                    class="w-5 h-5"
                    @click="bookmark = !bookmark"
                  />
                </div>
              </div>
              <div class="!mt-3.5">
                <hr />
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-1.5">
                  <UtilsIcon :icon="Icons.Star" class="w-4 h-4 text-red-500" />
                  <span>5.0</span>
                </div>
                <div class="text-sm text-gray-500">1k reviews</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
