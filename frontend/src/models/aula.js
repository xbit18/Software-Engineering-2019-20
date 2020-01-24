class Aula {
    constructor(id,code,building_id,availability,type,capacity,state,edificio, created_at,updated_at, floor){
        this.id = id;
        this.code = code;
        this.availability = availability;
        this.type = type;
        this.capacity = capacity;
        this.state = state;
        this.floor = floor;
        this.building_id = building_id;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}

export default Aula