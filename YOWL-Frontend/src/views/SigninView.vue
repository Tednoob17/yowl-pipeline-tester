<template>
  <div class="root">
      <div class="tw-flex tw-w-full tw-h-[90vh] tw-my-auto tw-backdrop-blur-lg">
        <div
          class="tw-flex tw-h-full tw-backdrop-blur-xl tw-rounded-tr-[100px] tw-rounded-br-[100px] p-5 tw-flex-col tw-items-center tw-justify-center"
        >
          <div class="tw-flex tw-flex-col tw-items-center tw-justify-center">
            <img class="tw-z-10" width="250px" height="250px" src="../assets/img/pandas_1.png" alt="" />
            <img
              class="tw-bg-transparent tw-absolute"
              width="300px"
              height="300px"
              src="../assets/img/white-outline.png"
              alt="image"
            />
          </div>
          <div class="tw-w-5/6 text-center mt-8">
            <span>No one enters unless</span> <span class="tw-text-blue-500">He</span> or
            <span class="tw-text-blue-500">She</span> is Registered .
          </div>
        </div>
        <div>
          <v-form>
            <v-text-field></v-text-field>
          </v-form>
        </div>
      </div>
  </div>
</template>

<style scoped>
.root {
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url('../assets/img/bg-login.png');
  height: 100vh;
  background-color: #f5f5f5;
}
</style>
