<script setup>
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

defineProps(['educations']);

const form = useForm({
    diplome: '',
    etablissement: '',
    date_obtention: '',
    description: '',
});

const submit = () => {
    form.post('/education', {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <AppLayout>
        <div class="mt-8 mr-8 ml-8 flex items-center justify-between">
            <h1 class="text-4xl font-bold">Mon éducation</h1>
        </div>
        <!--Formulaire ajout éducation-->
        <form
            @submit.prevent="submit"
            class="m-8 flex flex-col gap-4 rounded-lg border p-6 shadow-md"
        >
            <div>
                <label for="diplome" class="block font-medium">Diplôme</label>
                <input
                    v-model="form.diplome"
                    type="text"
                    id="diplome"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="etablissement" class="block font-medium"
                    >Établissement</label
                >
                <input
                    v-model="form.etablissement"
                    type="text"
                    id="etablissement"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="date_obtention" class="block font-medium"
                    >Date d'obtention</label
                >
                <input
                    v-model="form.date_obtention"
                    type="date"
                    id="date_obtention"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                />
            </div>
            <div>
                <label for="description" class="block font-medium"
                    >Description</label
                >
                <textarea
                    v-model="form.description"
                    id="description"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm"
                ></textarea>
            </div>
            <button
                type="submit"
                class="self-end rounded bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700"
            >
                Ajouter l'éducation
            </button>
        </form>
        <!--Liste des éducations-->
        <div class="grid gap-6 p-8 md:grid-cols-2 lg:grid-cols-3">
            <Card
                v-for="educ in educations"
                :key="educ.id"
                class="cursor-pointer transition-shadow hover:shadow-lg"
            >
                <CardHeader>
                    <CardTitle>{{ educ.diplome }}</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ educ.etablissement }}</p>
                    <p>{{ educ.date_obtention }}</p>
                    <p>{{ educ.description }}</p>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
