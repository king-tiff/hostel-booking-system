<template>
    <div class="flex flex-wrap -mx-2">
      <div
        v-for="(item, index) in 8"
        :key="index"
        class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 mb-4"
      >
        <div class="relative rounded-lg overflow-hidden shadow-lg fruite-item transition-transform transform hover:scale-105">
          <div class="fruite-img">
            <img
              src="@/Pages/Home/Partials/image/Room1.jpg"
              class="w-full rounded-t-lg"
              alt="Room image"
            />
          </div>
          <div
            class="text-white bg-gray-800 bg-opacity-75 px-3 py-1 rounded absolute top-2 left-2"
          >
            Master Rooms
          </div>
          <div class="p-4 border border-gray-200 rounded-b-lg bg-white">
            <h4 class="text-xl font-semibold mb-2">4 People Room</h4>
            <p class="text-gray-700 mb-4">
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
              eiusmod te incididunt
            </p>
            <div class="flex justify-between items-center">
              <p class="text-black text-lg font-bold mb-0">250,000Tsh / Semister</p>
              <a
                href="#"
                class="btn border border-gray-300 rounded-full px-3 py-2 text-blue-600 flex items-center hover:bg-gray-100"
              >
                <i class="fa fa-shopping-bag mr-2 text-blue-600"></i> View More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <style scoped>
  .fruite-item {
    transition: transform 0.3s;
  }
  </style>
  