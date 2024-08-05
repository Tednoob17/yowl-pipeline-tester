<template>
    <main class="tw-bg-white">
        <div class="tw-flex tw-border-b tw-border-b-black">
            <div class="tw-w-[25%] tw-px-4 tw-hidden md:tw-block">
                <h1 class="tw-mt-4 tw-text-slate-800 tw-font-bold tw-text-lg">Personnal Information</h1>
                <p class="tw-text-slate-600 tw-text-md tw-text-justify">This section allows you to change your personal account information. Use a permanent address where you can receive mail.</p>
            </div>
            <div class="md:tw-w-[75%] tw-w-full">
                <div class="md:tw-flex">
                    <img class="tw-h-20 tw-rounded-lg tw-mt-4 tw-mx-4" src="../../assets/profile photo.jpg" alt="">
                    <div class="tw-mt-6">
                        <button class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-p-2 tw-m-2 tw-text-white tw-bg-blue-800">Change the avatar</button>
                        <p class="tw-text-slate-800 tw-font-bold tw-text-sm">JPG, GIF or PNG. 1MB max.</p>
                    </div> 
                    <div class="tw-mt-6 tw-ml-8">
                        <button class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-p-1 tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2">Logout</button>
                    </div>                
                    </div>
                <div>
                    <form action="">
                        <div class="tw-flex">
                            <div class="tw-mt-4 tw-pr-4 tw-w-1/2">
                            <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for="">First name</label>
                            <input class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]" type="text" required>
                            </div>
                            <div class="tw-mt-4 tw-pr-4 tw-w-1/2">
                            <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for="">Last name</label>
                            <input class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]" type="text" required>
                            </div>
                        </div>
                        <div class="tw-flex">
                            <div class="tw-mt-4 tw-pr-4 tw-w-2/3">
                            <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for="">Email adress</label>
                            <input class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]" type="text" required>
                            </div>
                            <div class="tw-mt-4 tw-pr-4 tw-w-1/3">
                            <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for="">Birthdate</label>
                            <input class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]" type="date" required>
                            </div>
                        </div>
                        <button class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-p-1 tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2">Save change</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-border-b tw-border-b-black">
            <div class="tw-w-[25%] tw-px-4 tw-hidden md:tw-block">
                <h1 class="tw-mt-4 tw-text-slate-800 tw-font-bold tw-text-lg">Password update</h1>
                <p class="tw-text-slate-600 tw-text-md tw-text-justify">Change your password. For the security of your account, it is recommended to use a strong password containing at least 8 characters.</p>
            </div>
            <div class="md:tw-w-[75%] tw-w-full">
                <div>
                    <form action="">
                        <div class="tw-mt-4 tw-pr-4">
                            <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for="">Old password</label>
                            <input class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]" type="password" required>
                            </div>
                        <div class=" tw-grid">
                            <div class="tw-mt-4 tw-pr-4 md:tw-w-1/2 tw-min-w-full">
                            <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for="">New password</label>
                            <input class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]" type="password" required>
                            </div>
                            <div class="tw-mt-4 tw-pr-4 md:tw-w-1/2 tw-min-w-full">
                            <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for="">New password confirmation</label>
                            <input class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]" type="password" required>
                            </div>
                        </div>
                        <button class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-p-1 tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tw-flex tw-border-b tw-border-b-black">
            <div class="tw-w-[25%] tw-px-4 tw-hidden md:tw-block">
                <h1 class="tw-mt-4 tw-text-slate-800 tw-font-bold tw-text-lg">Preferences</h1>
                <p class="tw-text-slate-600 tw-text-md tw-text-justify">Add your preferences here.</p>
            </div>
            <div class="md:tw-w-[75%] tw-w-full">
                <div>
                    <form action="">
                        <div class="tw-mt-4 tw-pr-4 tw-flex">
                            <label class="checkbox tw-text-slate-800 tw-text-lg tw-mx-2 tw-my-auto tw-font-bold" for="">Enable or disable 2FA</label>
                           <div class="tw-pt-2"><input class="tw-h-6 tw-w-6 tw-my-auto" type="checkbox" id="checkbox"></div>
                            </div>
                        <button class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-p-1 tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="tw-grid tw-justify-center">
            <div class="place-self-end"> <button class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-p-1 tw-m-2 tw-text-white tw-bg-red-600 tw-px-4 tw-text-ml tw-p-2">Delete my account</button> </div>
        </div>
    </main>
</template>
