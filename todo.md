V 1 - creare migrazioni per tutte le tabelle
fatto alcuni 2 - creare qualche seeder
3 - convertire endpoint in api json
  a) creare tabella token con sistema di autenticazione
  b)creare le diverse chiamate api con header autenicazione token
4 - rifare la ui con vue con le api
  a) da fare add,
  b)update,
  c)remove di Player e Activity
5) installare material deisgn per rendere il layout piu bello

cose fatte:
1)aggiunto controlle player e activity diverso sulle api
2) inserito le classi playerResource e activityResource che trasformano l'object in output
3) creato quindi l'index di player e activityTypes da finire layout per parametri extra

considerazioni:
le variabili player, activity, game, servono in piu parti del codice valutare se salvarle in localStorage



# Comandi docker:
d -> avvia i container

# Dalla cartella del progetto:
dc -> composer
da -> artisan

# Comandi di stup laravel:
artisan db:migrate
artisan db:seed

# Comandi Vue:
yarn -> crea/aggiorna node_modules
yarn serve -> avvia il server di sviluppo

# Altri comandi:
atom node_modules/bootstrap/scss/_variables.scss
