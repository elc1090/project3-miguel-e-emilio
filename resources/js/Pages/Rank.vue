<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import Welcome from '../Components/Welcome.vue';

defineProps({
    teams: {
        type: Array,
        required: true
    },
    team_users: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div>

                        <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                            <div>
                                <div class="flex items-center">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Team
                                    </h2>
                                </div>

                                <div class="mt-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400 text-sm">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">Rank</th>
                                                <th scope="col" class="px-6 py-3">User</th>
                                                <th scope="col" class="px-6 py-3">Questions</th>
                                                <th scope="col" class="px-6 py-3">Ratio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(user, index) in team_users" class="dark:border-gray-700 border-b"
                                                :class="user.id === $page.props.auth.user.id ? [
                                                        'dark:bg-amber-300', 'text-red-700'
                                                    ] : [
                                                        'bg-white', 'even:bg-gray-50', 'dark:bg-gray-900', 'even:dark:bg-gray-800'
                                                    ]">
                                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                    {{ index + 1 }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ user.name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ user.answered_questions.length }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ user.score }}%
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Global
                                    </h2>
                                </div>


                                <div class="mt-6 relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400 text-sm">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Rank</th>
                                            <th scope="col" class="px-6 py-3">User</th>
                                            <th scope="col" class="px-6 py-3">Questions</th>
                                            <th scope="col" class="px-6 py-3">Ratio</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(team, index) in teams" class="dark:border-gray-700 border-b"
                                            :class="team.id === $page.props.auth.user.current_team_id ? [
                                                        'dark:bg-amber-300', 'text-red-700'
                                                    ] : [
                                                        'bg-white', 'even:bg-gray-50', 'dark:bg-gray-900', 'even:dark:bg-gray-800'
                                                    ]">
                                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                                {{ index + 1 }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ team.name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ team.answeredQuestions.length }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ team.score }}%
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <Welcome />-->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
