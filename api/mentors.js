// api/match.js

export default async function handler(req, res) {
  const { goal, level, language } = req.query;

  console.log("Query received:", { goal, level, language });
  // TODO: Replace this with a real database query
  const mentors = [
    { name: "Ravi Sharma", expertise: "frontend", level: "beginner", language: "english", availability: "Weekends" },
    { name: "Ananya Das", expertise: "backend", level: "intermediate", language: "bengali", availability: "Evenings" },
    { name: "Amit Verma", expertise: "fullstack", level: "advanced", language: "hindi", availability: "Weekdays" }
  ];

  const matches = mentors.filter(m =>
    m.expertise === goal &&
    m.level === level &&
    m.language === language
  );

  res.status(200).json({ matches });
}
