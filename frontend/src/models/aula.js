class Aula {
    constructor(id,codice,id_edificio,nome_edificio,disponibilita,tipo,capienza,stato,edificio, created_at,updated_at, piano){
        this.id = id;
        this.codice = codice;
        this.disponibilita = disponibilita;
        this.tipo = tipo;
        this.capienza = capienza;
        this.stato = stato;
        this.piano = piano;
        this.id_edificio = id_edificio;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Aula