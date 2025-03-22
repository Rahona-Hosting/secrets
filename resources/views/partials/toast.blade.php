<div id="toast-container" class="fixed top-5 right-5 z-50"></div>
<template id="toast-template">
    <div
        class="flex items-center w-full max-w-xs p-4 mb-4 rounded-lg shadow text-gray-500 bg-white dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg">
            <i class="text-xl"></i>
        </div>
        <div class="ml-3 text-sm font-normal"></div>
        <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 inline-flex h-8 w-8 hover:bg-gray-100 dark:hover:bg-gray-700"
                aria-label="Close">
            <i class="fas fa-times text-sm"></i>
        </button>
    </div>
</template>
