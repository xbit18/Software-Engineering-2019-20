class PrenotazioneAula{
    constructor(id,state,start_date,end_date,motivation,classroom_id,user_id,name,surname,created_at,updated_at){
        this.id = id;
        this.state = state;
        this.start_date = start_date;
        this.end_date = end_date;
        this.motivation = motivation;
        this.classroom_id = classroom_id;
        this.user_id = user_id;
        this.name = name;
        this.surname = surname;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default PrenotazioneAula;