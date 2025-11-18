<script setup>
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

defineProps(['projets']);

const goToCreate = () => {
    router.visit('/projets/create');
};
</script>

<template>
    <AppLayout>
        <div class="mt-8 mr-8 ml-8 flex items-center justify-between">
            <h1 class="text-4xl font-bold">Mes projets</h1>
            <Button class="cursor-pointer" @click="goToCreate">
                Ajouter un projet
            </Button>
        </div>

        <!--Liste des projets-->
        <div class="grid gap-6 p-8 md:grid-cols-2 lg:grid-cols-3">
            <Card
                v-for="projet in projets"
                :key="projet.id"
                class="cursor-pointer transition-shadow hover:shadow-lg"
            >
                <CardHeader>
                    <CardTitle>{{ projet.titre }}</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>{{ projet.description_courte }}</p>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
