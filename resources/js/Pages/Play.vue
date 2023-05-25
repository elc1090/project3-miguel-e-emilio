<script>
import AppLayout from '../Layouts/AppLayout.vue';
import Question from '../Components/Question.vue';

export default {
    components: {Question, AppLayout},

    props: {
        question: {
            type: String,
            required: true
        },
        choices: {
            type: Array,
            required: true
        }
    },

    created(){
        console.log(this.choices)
    }

}

</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Question :question="question" :choices="choices" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
