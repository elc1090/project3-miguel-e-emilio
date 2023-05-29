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
        question_id: {
            type: String,
            required: true
        },
        question_number: {
            type: Number,
            required: true
        },
        choices: {
            type: Array,
            required: true
        }
    }
}

</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <Question
                        :question="question"
                        :choices="choices"
                        :question_number="question_number"
                        :question_id="question_id"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
