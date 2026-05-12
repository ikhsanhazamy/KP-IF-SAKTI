function Card({ title, desc }) {
  return (
    <div style={{ border: "1px solid #ddd", padding: "20px" }}>
      <h3>{title}</h3>
      <p>{desc}</p>
    </div>
  );
}

export default Card;