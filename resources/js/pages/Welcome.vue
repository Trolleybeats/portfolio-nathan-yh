<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardTitle,
} from '@/components/ui/card';
import { dashboard, login } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

const props = withDefaults(
    defineProps<{
        canRegister: boolean;
        profil: any;
        technologies: any[];
        projets: any[];
        education: any[];
        experiences: any[];
    }>(),
    {
        canRegister: true,
    },
);

const envoyerMail = () => {
    window.location.href = `mailto:${props.profil.email}`;
};
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
        <header
            class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl"
        >
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="dashboard()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Se connecter
                    </Link>
                </template>
            </nav>
        </header>
    </div>
    <div class="flex items-center gap-8 p-8">
        <div class="flex-1">
            <h1>Bonjour, je m'appelle {{ profil.nom }} {{ profil.prenom }}</h1>
            <p>{{ profil.titre }}</p>
            <p>{{ profil.bio }}</p>
            <button
                class="mt-4 rounded-sm bg-[#191400] px-5 py-1.5 text-sm leading-normal text-[#FDFDFC] hover:bg-[#2c2a00] dark:bg-[#EDEDEC] dark:text-[#1b1b18] dark:hover:bg-[#c4c2bd]"
                @click="envoyerMail"
            >
                Contactez-moi
            </button>
        </div>
        <figure class="flex-shrink-0">
            <img
                :src="`/storage/${profil.profil_photo}`"
                :alt="`Photo de profil de ${profil.prenom} ${profil.nom}`"
                class="h-64 w-64 rounded-lg object-cover"
            />
        </figure>
    </div>
    <div class="p-8">
        <h2 class="mb-4 text-2xl font-bold">Technologies</h2>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6">
            <div
                v-for="tech in technologies"
                :key="tech.id"
                class="flex flex-col items-center"
            >
                <p class="text-center">{{ tech.nom }}</p>
                <p class="text-gray-600">{{ tech.categorie }}</p>
                <p class="text-sm text-gray-500">{{ tech.niveau }}</p>
            </div>
        </div>
    </div>
    <div class="flex flex-row flex-wrap p-8">
        <h2 class="mb-4 w-full text-2xl font-bold">Projets</h2>
        <Card
            v-for="projet in projets"
            :key="projet.id"
            class="m-4 mb-4 flex-1"
        >
            <CardContent>
                <CardTitle>{{ projet.titre }}</CardTitle>
                <CardDescription>{{
                    projet.description_courte
                }}</CardDescription>
            </CardContent>
        </Card>
    </div>
    <div class="p-8">
        <h2 class="mb-4 text-2xl font-bold">Expériences</h2>
        <div
            v-for="experience in experiences"
            :key="experience.id"
            class="mb-6"
        >
            <h3 class="text-xl font-semibold">{{ experience.poste }}</h3>
            <p class="text-gray-600">{{ experience.entreprise }}</p>
            <p class="text-gray-600">{{ experience.type }}</p>
            <p class="text-sm text-gray-500">
                {{ experience.date_debut }} -
                {{ experience.date_fin || 'Présent' }}
            </p>
            <div v-html="experience.description"></div>
        </div>
    </div>
    <div class="p-8">
        <h2 class="mb-4 text-2xl font-bold">Éducation</h2>
        <div v-for="educ in education" :key="educ.id" class="mb-6">
            <h3 class="text-xl font-semibold">{{ educ.diplome }}</h3>
            <p class="text-gray-600">{{ educ.etablissement }}</p>
            <p class="text-sm text-gray-500">
                {{ educ.date_obtention }}
            </p>
            <div v-html="educ.description"></div>
        </div>
    </div>
</template>
