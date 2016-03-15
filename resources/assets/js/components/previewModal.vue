<template>
    <div class="modal">
        <input class="modal-state" id="modal-1" type="checkbox" />
        <div class="modal-fade-screen">
            <div class="modal-inner">
                <div class="modal-close" for="modal-1"></div>
                <p class="modal-content"></p>
            </div>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function() {
            return {
                content: ''
            }
        },

        methods: {
            fetchPreview: function(text) {
                
            }
        }
    }
</script>