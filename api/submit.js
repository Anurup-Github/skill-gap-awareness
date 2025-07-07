export default function handler(req, res) {
  if (req.method === 'POST') {
    const { name, email, motivation, level, goal, language } = req.body;

    // Log to debug
    console.log("Received:", { name, email, motivation, level, goal, language });

    // TODO: Save to DB here

    res.status(200).json({ message: "Thanks for registering!" });
  } else {
    res.status(405).json({ message: "Method not allowed" });
  }
}
